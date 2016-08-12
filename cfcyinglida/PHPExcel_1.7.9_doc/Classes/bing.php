<?php

//+------------------------+ 
//| pie3dfun.php//���ú��� | 
//+------------------------+

define("ANGLE_STEP", 5);    //���廭��Բ��ʱ�ĽǶȲ���

function draw_getdarkcolor($img,$clr)    //��$clr��Ӧ�İ�ɫ 
{ 
    $rgb    =    imagecolorsforindex($img,$clr); 
    return array($rgb["red"]/2,$rgb["green"]/2,$rgb["blue"]/2); 
}

function draw_getexy($a, $b, $d)    //��Ƕ�$d��Ӧ����Բ�ϵĵ����� 
{ 
    $d        =    deg2rad($d); 
    return array(round($a*Cos($d)), round($b*Sin($d))); 
}

function draw_arc($img,$ox,$oy,$a,$b,$sd,$ed,$clr)    //��Բ������ 
{ 
    $n                    =    ceil(($ed-$sd)/ANGLE_STEP); 
    $d                    =    $sd; 
    list($x0,$y0)        =    draw_getexy($a,$b,$d); 
    for($i=0; $i<$n; $i++)
 { 
        $d                =    ($d+ANGLE_STEP)>$ed?$ed:($d+ANGLE_STEP); 
        list($x, $y)    =    draw_getexy($a, $b, $d); 
        imageline($img, $x0+$ox, $y0+$oy, $x+$ox, $y+$oy, $clr); 
        $x0                =    $x; 
        $y0                =    $y; 
    } 
}

function draw_sector($img, $ox, $oy, $a, $b, $sd, $ed, $clr)    //������ 
{ 
    $n                    =    ceil(($ed-$sd)/ANGLE_STEP); 
    $d                    =    $sd; 
    list($x0,$y0)        =    draw_getexy($a, $b, $d); 
    imageline($img, $x0+$ox, $y0+$oy, $ox, $oy, $clr); 
    for($i=0; $i<$n; $i++) 
    { 
        $d                =    ($d+ANGLE_STEP)>$ed?$ed:($d+ANGLE_STEP); 
        list($x, $y)    =    draw_getexy($a, $b, $d); 
        imageline($img, $x0+$ox, $y0+$oy, $x+$ox, $y+$oy, $clr); 
        $x0                =    $x; 
        $y0                =    $y; 
    } 
    imageline($img, $x0+$ox, $y0+$oy, $ox, $oy, $clr); 
    list($x, $y)        =    draw_getexy($a/2, $b/2, ($d+$sd)/2); 
    imagefill($img, $x+$ox, $y+$oy, $clr); 
}

function draw_sector3d($img, $ox, $oy, $a, $b, $v, $sd, $ed, $clr)    //3d���� 
{ 
    draw_sector($img, $ox, $oy, $a, $b, $sd, $ed, $clr); 
    if($sd<180) 
    { 
        list($R, $G, $B)    =    draw_getdarkcolor($img, $clr); 
        $clr=imagecolorallocate($img, $R, $G, $B); 
        if($ed>180) $ed        =    180; 
        list($sx, $sy)        =    draw_getexy($a,$b,$sd); 
        $sx                    +=    $ox; 
        $sy                    +=    $oy; 
        list($ex, $ey)        =    draw_getexy($a, $b, $ed); 
        $ex                    +=    $ox; 
        $ey                    +=    $oy; 
        imageline($img, $sx, $sy, $sx, $sy+$v, $clr); 
        imageline($img, $ex, $ey, $ex, $ey+$v, $clr); 
        draw_arc($img, $ox, $oy+$v, $a, $b, $sd, $ed, $clr); 
        list($sx, $sy)        =    draw_getexy($a, $b, ($sd+$ed)/2); 
        $sy                    +=    $oy+$v/2; 
        $sx                    +=    $ox; 
        imagefill($img, $sx, $sy, $clr); 
    } 
}
function draw_getindexcolor($img, $clr)    //RBGת����ɫ 
{ 
    $R        =    ($clr>>16) & 0xff; 
    $G        =    ($clr>>8)& 0xff; 
    $B        =    ($clr) & 0xff; 
    return imagecolorallocate($img, $R, $G, $B); 
}

// ��ͼ�������������ͼƬ 
// $datLst Ϊ��������, $datLst Ϊ��ǩ����, $datLst Ϊ��ɫ���� 
// �������������ά��Ӧ����� 
function draw_img($datLst,$labLst,$clrLst,$a=250,$b=120,$v=20,$font=10) 
{ 
    $ox        =    5+$a; 
    $oy        =    5+$b; 
    $fw        =    imagefontwidth($font); 
    $fh        =    imagefontheight($font);

    $n        =    count($datLst);//���������

    $w        =    10+$a*2; 
    $h        =    10+$b*2+$v+($fh+2)*$n;

    $img    =    imagecreate($w, $h);

    //תRGBΪ����ɫ 
    for($i=0; $i<$n; $i++) 
        $clrLst[$i]    =    draw_getindexcolor($img,$clrLst[$i]);

    $clrbk    =    imagecolorallocate($img, 0xff, 0xff, 0xff); 
    $clrt    =    imagecolorallocate($img, 0x00, 0x00, 0x00);

    //��䱳��ɫ 
    imagefill($img, 0, 0, $clrbk);

    //��� 
    $tot    =    0; 
    for($i=0; $i<$n; $i++) 
        $tot    +=    $datLst[$i];
        $sd        =    0; 
    $ed        =    0; 
    $ly        =    10+$b*2+$v; 
    for($i=0; $i<$n; $i++) 
    { 
        $sd    =    $ed; 
        $ed    +=    $datLst[$i]/$tot*360;

        //��Բ�� 
        draw_sector3d($img, $ox, $oy, $a, $b, $v, $sd, $ed, $clrLst[$i]);    //$sd,$ed,$clrLst[$i]);

        //����ǩ 
        imagefilledrectangle($img, 5, $ly, 5+$fw, $ly+$fh, $clrLst[$i]); 
        imagerectangle($img, 5, $ly, 5+$fw, $ly+$fh, $clrt); 
        //imagestring($img, $font, 5+2*$fw, $ly, $labLst[$i].":".$datLst[$i]."(".(round(10000*($datLst[$i]/$tot))/100)."%)", $clrt);

        $str    =    iconv("GB2312", "UTF-8", $labLst[$i]); 
        ImageTTFText($img, $font, 0, 5+2*$fw, $ly+13, $clrt, "./simsun.ttf", $str.":".$datLst[$i]."(".(round(10000*($datLst[$i]/$tot))/100)."%)"); 
        $ly        +=    $fh+2; 
    }

    //���ͼ�� 
    header("Content-type: image/png");

    //������ɵ�ͼƬ 
    $imgFileName = "../temp/".time().".png"; 
    imagepng($img,$imgFileName); 
    echo '<IMG SRC="'.$imgFileName.'" BORDER="1" ALT="ͳ�Ʊ�ͼ">'; 
}

$datLst = array(30, 10, 20, 20, 10, 20, 10, 20);    //���� 
$labLst = array("�й��Ƽ���ѧ", "��������ѧ", "�廪��ѧ", "������ѧ", "�Ͼ���ѧ", "�Ϻ���ѧ", "�Ӻ���ѧ", "��ɽ��ѧ");    //��ǩ 
$clrLst = array(0x99ff00, 0xff6666, 0x0099ff, 0xff99ff, 0xffff99, 0x99ffff, 0xff3333, 0x009999);

//��ͼ 
draw_img($datLst,$labLst,$clrLst); 
?>