<?php
if(isset($_POST['submit'])){

/*
GETTING VALUES FROM FORM START HERE
************************************************/
if (isset($_POST['name'])) {$name = $_POST['name'];}else{$Larmtid='';}
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
        <h1 style="text-align:center">Save Chines Form Data To PDF</h1>
        <hr>
        <div style="padding:20px;">
            <p>Name: <?php echo $name;?></p>
        </div>

        <?php
        $body = ob_get_clean();

        //$body = iconv("UTF-8","UTF-8//IGNORE",$body);
        $body = iconv('UTF-8', 'UTF-8//IGNORE', $body);
        $body = iconv('UTF-8', 'UTF-8//TRANSLIT', $body);

        include("mpdf/mpdf.php");
        $mpdf=new \mPDF('c','A4','','' , 0, 0, 0, 0, 0, 0);
        $mpdf->SetAutoFont();
        $mpdf->autoScriptToLang = true;
        $mpdf->autoLangToFont   = true;


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
