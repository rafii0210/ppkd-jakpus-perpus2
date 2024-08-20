<<?php  

function pilihstatus($status) {
    switch ($status) {
        case '1':
           $label ='<span class="badged text-bg-primary">Sedang dipinjam</span>';
            break;
        case '2':
            $label ='<span class="badged text-bg-primary">Sudah dikembalikan</span>';
            break;
        
        default:
            $label = "";
            break;
    }
    return $label;
}

?>