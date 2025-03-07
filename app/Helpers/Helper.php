<?php
    if (!function_exists('toast_success')) {
        function toast_success($message)
        {
            session()->flash('toast', [
                'type' => 'success',
                'message' => $message,
                'toastClass' => 'custom-toast-success',
            ]);
        }
    }
    if (!function_exists('toast_success_img')) {
        function toast_success_img($message)
        {
            session()->flash('toast', [
                'type' => 'success',
                'message' => $message,
                'toastClass' => 'custom-toast-success',

            ]);
        }
    }
    if (!function_exists('toast_error')) {
        function toast_error($message)
        {
            session()->flash('toast', [
                'type' => 'error',
                'message' => $message,
                'toastClass' => 'custom-toast-success',
            ]);
        }
    }

    if (!function_exists('toast_info')) {
        function toast_info($message)
        {
            session()->flash('toast', [
                'type' => 'info',
                'message' => $message,
                'toastClass' => 'custom-toast-success',
            ]);
        }
    }

    if (!function_exists('sweet_alert_success')) {
        function sweet_alert_success($message)
        {
            session()->flash('sweet_alert', [
                'type' => 'success',
                'message' => $message,
                'toastClass' => 'custom-toast-success',
            ]);
        }
    }

function get_initials($fullName)
{
    // Séparer le nom complet en parties (prénom et nom)
    $nameParts = explode(' ', $fullName);

    // Vérifier s'il y a au moins deux parties
    // if (count($nameParts) < 2) {
    //     $firstNameInitial = substr($nameParts[0], 0, 1);
    //     $firstNameInitial2 = substr($nameParts[0], 1, 1);
    //     return strtoupper($firstNameInitial);
    // }

    // Récupérer la première lettre du prénom et du nom
    $firstNameInitial = substr($nameParts[0], 0, 1);
    // $lastNameInitial = substr($nameParts[1], 0, 1);

    // Combiner les initiales et les convertir en majuscules
    return strtoupper($firstNameInitial);

}
function get_initials2($fullName)
{
    // Séparer le nom complet en parties (prénom et nom)
    $nameParts = explode(' ', $fullName);

    //Vérifier s'il y a au moins deux parties
    if (count($nameParts) < 2) {
        $firstNameInitial = substr($nameParts[0], 0, 1);
        $firstNameInitial2 = substr($nameParts[0], 1, 1);
        return strtoupper($firstNameInitial);
    }

    // Récupérer la première lettre du prénom et du nom
    $firstNameInitial = substr($nameParts[0], 0, 1);
    $lastNameInitial = substr($nameParts[1], 0, 1);

    // Combiner les initiales et les convertir en majuscules
    return strtoupper($firstNameInitial.$lastNameInitial);

}
if (!function_exists('Ladate')) {
    function Ladate($ladate) {
        $mois = ['Janvier','Fevrier','Mars','Avril','Mai','Juin','Juillet','Août','Septembre','Octobre','Novembre','Decembre'];
        // $mois = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        $ladate = new DateTime($ladate);
        return $ladate->format('d').' '.$mois[$ladate->format('m')-1].' '.$ladate->format('Y');
    }
}
if (!function_exists('Ladate_heure')) {
    function Ladate_heure($ladate) {
        $mois = ['Janvier','Fevrier','Mars','Avril','Mai','Juin','Juillet','Août','Septembre','Octobre','Novembre','Decembre'];
        $ladate = new DateTime($ladate);
        return $ladate->format('d ').$mois[$ladate->format('m')-1].$ladate->format(' Y').' à '.$ladate->format(' H').'h'.$ladate->format(' i').'min';
    }
}
function removeEspace($nombres) {
    // Supprimer les espaces et convertir en un tableau de nombres
    $nombresTableau = explode(',', $nombres);

    // Rejoindre les nombres en une seule chaîne sans espace
    $resultat = implode('', $nombresTableau);

    return $resultat;
}
if (! function_exists('formatMontant')){

    function formatMontant($montant) {
        $montant=str_replace(' ', '', $montant);
        $montant = floatval($montant);
        return number_format($montant, 0, ',', ' ');
    }
}


if (!function_exists('time_elapsed')) {
    function time_elapsed($datetime, $full = false) {
        $now = Carbon\Carbon::now();
        $ago = Carbon\Carbon::parse($datetime);

        $diff = $now->diff($ago);

        if ($diff->y > 0) {
            return 'il y\'a '. $diff->y . ' an' . ($diff->y > 1 ? 's' : '');
        }

        if ($diff->m > 0) {
            return 'il y\'a '. $diff->m . ' mois';
        }

        if ($diff->d > 0) {
            return 'il y\'a '. $diff->d . ' jour' . ($diff->d > 1 ? 's' : '');
        }

        if ($diff->h > 0) {
            return 'il y\'a '. $diff->h . ' heure' . ($diff->h > 1 ? 's' : '');
        }

        if ($diff->i > 0) {
            return 'il y\'a '. $diff->i . ' minute' . ($diff->i > 1 ? 's' : '');
        }

        return 'À l\'instant';
    }
}

if (!function_exists('get_progress')) {
    function get_progress($date_debut, $date_fin) {
        // convertir les dates 
        $date_debut = strtotime($date_debut);
        $date_fin = strtotime($date_fin);
        $date_actuelle = time();

        // Calculs
        $jours_ecoules = $date_actuelle - $date_debut;
        $jours_totaux = $date_fin - $date_debut;
        $pourcentage = ($jours_ecoules / $jours_totaux) * 100;

        $pourcentage = min(100, max(0, round(($jours_ecoules / $jours_totaux) * 100)));
        // Arrondir le pourcentage
        $pourcentage = round($pourcentage);

        
        echo $pourcentage;
    }
}


