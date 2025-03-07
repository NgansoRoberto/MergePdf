<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use setasign\Fpdi\Tcpdf\Fpdi;
use Illuminate\Support\Facades\Storage;

class PdfController extends Controller
{
    /**
     * Convertit un PDF en version compatible avec FPDI
     */
    protected function convertPdf($inputPath, $outputPath)
    {
        // Utiliser le chemin complet vers gswin64c
        $gsPath = 'C:\Program Files\gs\gs10.04.0\bin\gswin64c.exe'; // Ajustez selon votre version
        $command = "\"$gsPath\" -sDEVICE=pdfwrite -dCompatibilityLevel=1.4 -dNOPAUSE -dQUIET -dBATCH -o \"$outputPath\" \"$inputPath\"";

        $output = shell_exec($command);

        return file_exists($outputPath);
    }

    public function mergePdf(Request $request)
    {
        $request->validate([
            'pdfFiles' => 'required|array',
            'pdfFiles.*' => 'required|mimes:pdf|max:10240', // 10MB max per file
        ]);

        // Créer un dossier temporaire pour les PDF convertis
        $tempDir = storage_path('app/temp');
        if (!file_exists($tempDir)) {
            mkdir($tempDir, 0777, true);
        }

        $convertedFiles = [];
        $conversionErrors = [];

        // Convertir tous les fichiers PDF
        foreach ($request->file('pdfFiles') as $index => $file) {
            $originalPath = $file->getPathname();
            $convertedPath = $tempDir . '/converted_' . $index . '_' . time() . '.pdf';

            if ($this->convertPdf($originalPath, $convertedPath)) {
                $convertedFiles[] = $convertedPath;
            } else {
                $conversionErrors[] = $file->getClientOriginalName();
            }
        }

        // Vérifier si des erreurs de conversion se sont produites
        if (!empty($conversionErrors)) {
            // Nettoyer les fichiers temporaires
            foreach ($convertedFiles as $file) {
                if (file_exists($file)) {
                    unlink($file);
                }
            }

            return redirect()->back()->with([
                'error' => 'Impossible de convertir les fichiers suivants : ' . implode(', ', $conversionErrors)
            ]);
        }

        // Fusionner les PDF convertis
        $pdf = new Fpdi();

        try {
            // Parcourir tous les fichiers convertis
            foreach ($convertedFiles as $filePath) {
                // Compter les pages du PDF source
                $pageCount = $pdf->setSourceFile($filePath);

                // Importer toutes les pages
                for ($i = 1; $i <= $pageCount; $i++) {
                    $template = $pdf->importPage($i);
                    $size = $pdf->getTemplateSize($template);

                    $pdf->AddPage($size['orientation'], [$size['width'], $size['height']]);
                    $pdf->useTemplate($template);
                }
            }

            // Générer un nom de fichier unique
            $outputFilename = 'merged_' . time() . '.pdf';
            $outputPath = public_path('storage/merged/' . $outputFilename);

            // Créer le répertoire s'il n'existe pas
            if (!file_exists(public_path('storage/merged'))) {
                mkdir(public_path('storage/merged'), 0777, true);
            }

            // Enregistrer le PDF fusionné
            $pdf->Output($outputPath, 'F');

            // Nettoyer les fichiers temporaires
            foreach ($convertedFiles as $file) {
                if (file_exists($file)) {
                    unlink($file);
                }
            }

            return redirect()->back()->with([
                'status' => 'Les PDF ont été fusionnés avec succès!',
                'mergedPdf' => asset('storage/merged/' . $outputFilename)
            ]);

        } catch (\Exception $e) {
            // Nettoyer les fichiers temporaires en cas d'erreur
            foreach ($convertedFiles as $file) {
                if (file_exists($file)) {
                    unlink($file);
                }
            }

            return redirect()->back()->with([
                'error' => 'Erreur lors de la fusion des PDF: ' . $e->getMessage()
            ]);
        }
    }
}
