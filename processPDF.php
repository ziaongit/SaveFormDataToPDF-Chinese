<?php
// Report all errors except E_NOTICE
error_reporting(E_ALL & ~E_NOTICE);

if(isset($_POST['submit'])){

/*
GETTING VALUES FROM FORM START HERE
************************************************/
if (isset($_POST['name'])) {$name = $_POST['name'];}else{$Ambnr='';}
/*
GETTING VALUES FROM FORM END HERE
************************************************/
/*
SAVE FORM DATA AS PDF START HERE
************************************************/
//if no errors carry on
if(!isset($error)){
    //create html of the data
    ob_start();
    ?>
    <div style="padding:20px;">
        <p>Name: <?php echo $name;?></p>
    </div>

    <?php
    $body = ob_get_clean();

    //$body = iconv("UTF-8","UTF-8//IGNORE",$body);
    $body = iconv('UTF-8', 'UTF-8//IGNORE', $body);

    include("mpdf/mpdf.php");
    $mpdf=new \mPDF('c','A4','','' , 0, 0, 0, 0, 0, 0);
    $mpdf->SetAutoFont();

    //write html to PDF
    $mpdf->WriteHTML($body);

    //output pdf
    $mpdf->Output('Akutjornal-enligt-RETTS-TM.pdf','D');
    //save to server
    //$mpdf->Output("mydata.pdf",'F');
}
/*
SAVE FORM DATA AS PDF END HERE
************************************************/

}

?>
