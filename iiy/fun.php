<?php 
function ignoreHTML2($text)
{
    $text = str_replace("999999.9", "", $text);
    $text = str_replace("union all select", "", $text);
    $text = str_replace("null", "", $text);
    $text = str_replace("NULL", "", $text);
    $text = str_replace("information_schema", "", $text);
   // $text = str_replace("where", "", $text);
   // $text = str_replace("WHERE", "", $text);
    $text = str_replace("--", "", $text);
    $text = str_replace("'", "", $text);
    $text = str_replace('"', '', $text);
    $text = strip_tags($text);
    $text = htmlentities($text);
   return ignoreHTML($text);
  
}
function findcount($tbl,$q,$dbh)
{
$v=NULL;	
	$v = $dbh->query('SELECT count(ID) FROM '.$tbl.' '.$q)->fetch(PDO::FETCH_NUM); 
return $v[0];
}

function ignoreHTML($val)
{
//	return str_replace(array('&lt;','&gt;'),array('<','>'), $val);
return str_replace(array('union all select','999999.9','&gt;'),array('',' ','>'), $val);
}



function cleanTAG($str) {
		$str = @trim($str);
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}

$str= str_replace(array("'",'"'),array('',''), $str);
$str=ignoreHTML2($str);
		return $str;
	}



function delimage($path)
{
if(file_exists($path))
	{
		unlink($path);
	}
}
function countnm($tbl,$q,$dbh)
{
	$v=NULL;	
	$rs9="Select * from $tbl $q";
	if(!$rs9) die(stl());
			foreach($dbh->query($rs9) as $row9)
				{
				$v++;
				}
	return $v;
} 

function sumcolm($tbl,$ro,$q,$dbh)
{
	$v=NULL;	
$qq='SELECT sum('.$ro.') FROM '.$tbl.' '.$q;

	$v = $dbh->query($qq)->fetch(PDO::FETCH_NUM); 
return $v[0];
} 

function email($to,$toadmin,$subject,$message)
{
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
	// More headers
	$headers .= 'From: <Online Karyana Store>' . "\r\n";
	if($to)mail($to,$subject,$message,$headers);
	if($toadmin)mail($toadmin,$subject,$message,$headers);
}
function findnm($tbl,$ro,$q,$dbh)
{
$v=NULL;	
	$rs9="Select * from $tbl $q";
	$stmt9 = $dbh->prepare($rs9);$stmt9->execute();
				if($stmt9->errorCode() == 0) 
					{
					while(($row9 = $stmt9->fetch()) != false) 
						{
						$v.= $row9[$ro];
						}
					}
return $v;
} 


function formatSizeUnits($bytes)
    {
        if ($bytes >= 1073741824)
        {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        }
        elseif ($bytes >= 1048576)
        {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        }
        elseif ($bytes >= 1024)
        {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        }
        elseif ($bytes > 1)
        {
            $bytes = $bytes . ' bytes';
        }
        elseif ($bytes == 1)
        {
            $bytes = $bytes . ' byte';
        }
        else
        {
            $bytes = '0 bytes';
        }

        return $bytes;
}




function convertNumber($number)
{
    list($integer, $fraction) = explode(".", (string) $number);

    $output = "";

    if ($integer{0} == "-")
    {
        $output = "negative ";
        $integer    = ltrim($integer, "-");
    }
    else if ($integer{0} == "+")
    {
        $output = "positive ";
        $integer    = ltrim($integer, "+");
    }

    if ($integer{0} == "0")
    {
        $output .= "zero";
    }
    else
    {
        $integer = str_pad($integer, 36, "0", STR_PAD_LEFT);
        $group   = rtrim(chunk_split($integer, 3, " "), " ");
        $groups  = explode(" ", $group);

        $groups2 = array();
        foreach ($groups as $g)
        {
            $groups2[] = convertThreeDigit($g{0}, $g{1}, $g{2});
        }

        for ($z = 0; $z < count($groups2); $z++)
        {
            if ($groups2[$z] != "")
            {
                $output .= $groups2[$z] . convertGroup(11 - $z) . (
                        $z < 11
                        && !array_search('', array_slice($groups2, $z + 1, -1))
                        && $groups2[11] != ''
                        && $groups[11]{0} == '0'
                            ? " and "
                            : ", "
                    );
            }
        }

        $output = rtrim($output, ", ");
    }

    if ($fraction > 0)
    {
        $output .= " point";
        for ($i = 0; $i < strlen($fraction); $i++)
        {
            $output .= " " . convertDigit($fraction{$i});
        }
    }

    return $output;
}

function convertGroup($index)
{
    switch ($index)
    {
        case 11:
            return " decillion";
        case 10:
            return " nonillion";
        case 9:
            return " octillion";
        case 8:
            return " septillion";
        case 7:
            return " sextillion";
        case 6:
            return " quintrillion";
        case 5:
            return " quadrillion";
        case 4:
            return " trillion";
        case 3:
            return " billion";
        case 2:
            return " million";
        case 1:
            return " thousand";
        case 0:
            return "";
    }
}

function convertThreeDigit($digit1, $digit2, $digit3)
{
    $buffer = "";

    if ($digit1 == "0" && $digit2 == "0" && $digit3 == "0")
    {
        return "";
    }

    if ($digit1 != "0")
    {
        $buffer .= convertDigit($digit1) . " hundred";
        if ($digit2 != "0" || $digit3 != "0")
        {
            $buffer .= " and ";
        }
    }

    if ($digit2 != "0")
    {
        $buffer .= convertTwoDigit($digit2, $digit3);
    }
    else if ($digit3 != "0")
    {
        $buffer .= convertDigit($digit3);
    }

    return $buffer;
}

function convertTwoDigit($digit1, $digit2)
{
    if ($digit2 == "0")
    {
        switch ($digit1)
        {
            case "1":
                return "ten";
            case "2":
                return "twenty";
            case "3":
                return "thirty";
            case "4":
                return "forty";
            case "5":
                return "fifty";
            case "6":
                return "sixty";
            case "7":
                return "seventy";
            case "8":
                return "eighty";
            case "9":
                return "ninety";
        }
    } else if ($digit1 == "1")
    {
        switch ($digit2)
        {
            case "1":
                return "eleven";
            case "2":
                return "twelve";
            case "3":
                return "thirteen";
            case "4":
                return "fourteen";
            case "5":
                return "fifteen";
            case "6":
                return "sixteen";
            case "7":
                return "seventeen";
            case "8":
                return "eighteen";
            case "9":
                return "nineteen";
        }
    } else
    {
        $temp = convertDigit($digit2);
        switch ($digit1)
        {
            case "2":
                return "twenty-$temp";
            case "3":
                return "thirty-$temp";
            case "4":
                return "forty-$temp";
            case "5":
                return "fifty-$temp";
            case "6":
                return "sixty-$temp";
            case "7":
                return "seventy-$temp";
            case "8":
                return "eighty-$temp";
            case "9":
                return "ninety-$temp";
        }
    }
}

function convertDigit($digit)
{
    switch ($digit)
    {
        case "0":
            return "zero";
        case "1":
            return "one";
        case "2":
            return "two";
        case "3":
            return "three";
        case "4":
            return "four";
        case "5":
            return "five";
        case "6":
            return "six";
        case "7":
            return "seven";
        case "8":
            return "eight";
        case "9":
            return "nine";
    }
}

 $num = 500254.89;
 $test = convertNumber($num);

return $test;


function printingR($tbl,$feeid,$copy,$dbh)
{
?>
 
<?php
	$sql1 = "SELECT * FROM $tbl where ID=$feeid order by ID DESC LIMIT 1";
						$stmt = $dbh->prepare($sql1);
						$stmt->execute();
						if($stmt->errorCode() == 0) 
							{
							while(($row = $stmt->fetch()) != false) 
								{
								$dt=date("d-m-Y",strtotime($row['DATE1']));
								$recid=$row['ID'];						
								$id=$row['SID'];						
								$amt=$row['AMT'];						
								$paidamt=$row['AMT'];						
								$rem=$row['REM'];						
								$rem2=$row['REM2'];						
								$rem3=$row['DES'];						
								$ocamt=$row['OCAMT'];						
								}
							}
		$sql1 = "SELECT * FROM reg where ID=$id order by ID DESC LIMIT 1";
						$stmt = $dbh->prepare($sql1);
						$stmt->execute();
						if($stmt->errorCode() == 0) 
							{
							while(($row = $stmt->fetch()) != false) 
								{
								$code=$row['ADMNO'];
								$nm=$row['NM'];
								$fnm=$row['FNM'];
								$ad=$row['PADD1'];
								$adfee=$row['ADFEE'];
								$tf=$row['TF'];
								$course=$row['COURSE'];
	$dtfrom=date("d-m-Y",strtotime($row['DATE1']));
							
								}
							}	

		$sql1 = "SELECT * FROM state where ID=$course order by ID DESC";
						$stmt = $dbh->prepare($sql1);
						$stmt->execute();
						if($stmt->errorCode() == 0) 
							{
							while(($row = $stmt->fetch()) != false) 
								{
						if($adfee==0)$adfee=$row['ADFEE'];
						if($adfee==1)$adfee=$row['ADFEED'];
						if($adfee==2)$adfee=$row['READM'];
						if($tf==0)$tf=$row['TF'];
						if($tf==1)$tf=$row['TFD'];
						$cl=$row['STATE'];
								}
							}


			$rem2=explode(",",$rem2);

if($tbl=="paid_fee")
{
		$sql11 = "SELECT * FROM school_info order by ID DESC";
		    foreach ($dbh->query($sql11) as $row11)
        		{
			$hdnm=$row11['NM'];
			$subnm=$row11['AD'];
							
							}
global $login_name;
			$copy1=$copy;
			$logo='<img src="assets/img/'.$login_name.'/logo.png" width="60" style="margin-left:20px;">';

			if($rem2[0]=="Amalgamated Fund")
			{
				$fee="<tr><td>Amalgamated Fund <td align=right>".$adfee;
	$totalamt=$totalamt+$adfee;

				$tfs=$amt-$adfee;
				if(trim($rem2[1])=="Tution Fee")$fee=$fee."<tr><td>Tution Fee <div class='mnth'>(".$rem3.")</div><td align=right>".$tfs;
	$totalamt=$totalamt+$tfs;

			}
			else 
			{
				$tfs=$amt-$ocamt;
			$fee=$fee."<tr><td>Tution Fee <div class='mnth'>(".$rem3.")</div><td align=right>".$tfs;
$totalamt=$totalamt+$tfs;
			}
	
}else{

			$fee=$fee."<tr><td>Van Charges <div class='mnth'>(".$rem3.")</div><td align=right>".$amt;
			$hdnm=$copy;
			$copy1="";
			$subnm="";
			$logo="";
$totalamt=$totalamt+$amt;

}

			?>


			<table class="tb" cellpadding="0"  border="0" width="300">
			<tr>
					<td width="60"  align="center" rowspan="3"><?php echo $logo; ?></td>

			<td align="right" class="cpy">
			<?php
		echo $copy1;
			?>
				<tr>
					<td align="center" width="500" class="ps"><?php echo $hdnm; ?></td>
				</tr>	
				<tr>
				<td align="center">
				<div class="ad"><?php echo $subnm; ?></div>
			<?php
			?>
				<tr>
				<td colspan="2" align="center">
			<table  border="0" class="sub"  width="100%">
			<tr><td class="cd" >
			Rec. No. <td width="180" ><?php  echo $recid; ?>
			<tr><td class="cd" >
			Code No./Adm.No. <td width="180" ><?php  echo $code; ?>
			<tr><td class="cd">
			Name 
			<td><?php  echo $nm; ?>
			<tr><td class="cd">
			Father's Name 
			<td><?php  echo $fnm; ?>
			<tr><td class="cd">
			Address 
			<td><?php  echo $ad; ?>
			<tr><td class="cd">
			Class
			<td><?php  echo $cl; ?>
			</table>
			<table  cellpadding="5"  cellspacing="0" border="0" class="sub2" width="90%">

				<?php  echo $fee; 

			if($rem!="")
				{
				?>

			<tr><td>
				<?php  echo $rem; ?>
			<td align=right>	
				<?php  echo $ocamt; 
			$amt=$adfee+$ocamt;
$totalamt=$totalamt+$ocamt;
			}	
			echo "<tr><td  class='yr'>Total <td align=right class='yr'>".$totalamt;
			echo "<tr><td  class='yr'>Paid <td align=right class='yr'>".$paidamt;

			echo "<tr><td class='wrd' colspan=2>".convertNumber($paidamt);
				?> Rs. Only
			<tr><td align="right" colspan="2" style="font-size:10px"><br><br>
				</td>
				</tr>
			</table>
			<tr><td align="center" colspan=2>
			<br>
			<table width=90%  style="font-size:10px"> 
			<tr><td>	Date: <?php echo $dt; ?>
			<td align=right>
			Deposited by .......................
			</table>
				</td>
				</tr>

</table>
<?php
}

function datawithcomma($dataxx,$ar)
{
$vl="";
	for($xxx=0;$xxx<count($dataxx);$xxx++)
	{
		if($xxx==0)
			$vl=$dataxx[$xxx][$ar];
		else
			$vl=$vl.','.$dataxx[$xxx][$ar];
	}
return $vl;
}



function is_connected()
{
    $connected = @fsockopen("www.example.com", 80); 
                                        //website, port  (try 80 or 443)
    if ($connected){
        $is_conn = true; //action when connected
        fclose($connected);
    }else{
        $is_conn = false; //action in connection failure
    }
    return $is_conn;

}


function PostRequest($url, $referer, $_data) { 

 // convert variables array to string: 

	 $data = array(); 

	 while(list($n,$v) = each($_data))
         { 
		 $data[] = "$n=$v"; 
		 } 
 $data = implode('&', $data); 
 // format --> test1=a&test2=b etc. 
 // parse the given URL 
 $url = parse_url($url); 
	 if ($url['scheme'] != 'http') { 
			 die('Only HTTP request are supported !'); 
		 } 

	 $host = $url['host']; 
	 $path = $url['path']; 
 // open a socket connection on port 80 

 $fp = @fsockopen($host, 80,$errno,$errstr,30); 

 // send the request headers: 

if(!$fp){

	echo $errno;

exit;

}

fputs($fp, "POST $path HTTP/1.1\r\n"); 

 fputs($fp, "Host: $host\r\n"); 

 fputs($fp, "Referer: $referer\r\n"); 

 fputs($fp, "Content-type: application/x-www-form-urlencoded\r\n"); 

 fputs($fp, "Content-length: ". strlen($data) ."\r\n"); 

 fputs($fp, "Connection: close\r\n\r\n"); 

 fputs($fp, $data); 

 $result = ''; 

 while(!feof($fp)) { 

 // receive the results of the request 

 $result .= fgets($fp, 128); 

 } 

 // close the socket connection: 

 fclose($fp); 

 // split the result header from the content 

 $result = explode("\r\n\r\n", $result, 2); 

 $header = isset($result[0]) ? $result[0] : ''; 

 $content = isset($result[1]) ? $result[1] : ''; 

 // return as array: 

 return array($header, $content); 

}

function createThumbs( $pathToImages, $pathToThumbs, $thumbWidth )
{

// load image and get image size
$img = imagecreatefromjpeg( "{$pathToImages}" );
$width = imagesx( $img );
$height = imagesy( $img );

// calculate thumbnail size
$new_width = $thumbWidth;
$new_height =  floor( $height * ( $thumbWidth / $width ) );
//$new_height =  $thumbWidth;// floor( $height * ( $thumbWidth / $width ) );

// create a new temporary image
$tmp_img = imagecreatetruecolor( $new_width, $new_height );

// copy and resize old image into new image
imagecopyresampled( $tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height );

// save thumbnail into a file
imagejpeg( $tmp_img, "{$pathToThumbs}" );

}

function updatesms($msg,$tp)
{
	$lnth=strlen($msg);
	if($lnth <=60) 
		$noc=1;
	else if ($lnth <=120)
		$noc =2;
	else if ($lnth <=180)
		$noc =3;
	else if ($lnth <=240)
		$noc =4;
	else if ($lnth <=300)
		$noc =5;
	else if ($lnth <=360)
		$noc =6;
	else if ($lnth <=420)
		$noc =7;
	else if ($lnth <=460)
		$noc =8;
	else
		$noc=9;	
return $noc;
}




function numberTowords($num)
{ 
$ones = array(
0 =>"ZERO", 
1 => "ONE", 
2 => "TWO", 
3 => "THREE", 
4 => "FOUR", 
5 => "FIVE", 
6 => "SIX", 
7 => "SEVEN", 
8 => "EIGHT", 
9 => "NINE", 
10 => "TEN", 
11 => "ELEVEN", 
12 => "TWELVE", 
13 => "THIRTEEN", 
14 => "FOURTEEN", 
15 => "FIFTEEN", 
16 => "SIXTEEN", 
17 => "SEVENTEEN", 
18 => "EIGHTEEN", 
19 => "NINETEEN",
"014" => "FOURTEEN" 
); 
$tens = array( 
0 => "ZERO",
1 => "TEN",
2 => "TWENTY", 
3 => "THIRTY", 
4 => "FORTY", 
5 => "FIFTY", 
6 => "SIXTY", 
7 => "SEVENTY", 
8 => "EIGHTY", 
9 => "NINETY" 
); 
$hundreds = array( 
"HUNDRED", 
"THOUSAND", 
"MILLION", 
"BILLION", 
"TRILLION", 
"QUARDRILLION" 
); //limit t quadrillion 
$num = number_format($num,2,".",","); 
$num_arr = explode(".",$num); 
$wholenum = $num_arr[0]; 
$decnum = $num_arr[1]; 
$whole_arr = array_reverse(explode(",",$wholenum)); 
krsort($whole_arr,1); 
$rettxt = ""; 
foreach($whole_arr as $key => $i){
while(substr($i,0,1)=="0")
$i=substr($i,1,5);
if($i < 20){ 
//echo "getting:".$i;
$rettxt .= $ones[$i]; 
}elseif($i < 100){ 
if(substr($i,0,1)!="0")  $rettxt .= $tens[substr($i,0,1)]; 
if(substr($i,1,1)!="0") $rettxt .= " ".$ones[substr($i,1,1)]; 
}else{ 
if(substr($i,0,1)!="0") $rettxt .= $ones[substr($i,0,1)]." ".$hundreds[0]; 
if(substr($i,1,1)!="0")$rettxt .= " ".$tens[substr($i,1,1)]; 
if(substr($i,2,1)!="0")$rettxt .= " ".$ones[substr($i,2,1)]; 
} 
if($key > 0){ 
$rettxt .= " ".$hundreds[$key]." "; 
} 
} 
if($decnum > 0){ 
$rettxt .= " and "; 
if($decnum < 20){ 
$rettxt .= $ones[$decnum]; 
}elseif($decnum < 100){ 
$rettxt .= $tens[substr($decnum,0,1)]; 
$rettxt .= " ".$ones[substr($decnum,1,1)]; 
} 
} 
return $rettxt; 
} 

function ArrayReplace($Array, $Find, $Replace){
  if(is_array($Array)){
 foreach($Array as $Key=>$Val) {
if(is_array($Array[$Key])){
   $Array[$Key] = ArrayReplace($Array[$Key], $Find, $Replace);
}else{
   if($Key == $Find) {
  $Array[$Key] = $Replace;
   }
}
 }
  }
  return $Array;
}
function createoptions($tbl,$id,$field,$seleced,$dbh)
{
	$rs9="Select * from $tbl";
			foreach($dbh->query($rs9) as $row9)
				{
	    if($row9[$id]==$seleced)
		echo "<option selected value=\"{$row9[$id]}\">$row9[$field]</option>";
	    else
		echo "<option value=\"{$row9[$id]}\">$row9[$field]</option>";
				}
}
?>
