<?php //require_once './lock.php';
$data="<style>
caption{
	background: red;
	height: 3em;
	line-height: 3em;
	box-shadow: 3px 0 2px black;
	color: white;
  font-family: 'Josefin Sans', sans-serif;
}

caption a{
	color: white;
}

table{
	background: #ddd;
	font-size: 20px;
	border-collapse: collapse;
	box-shadow: 3px 3px 2px black;
}

table,th,tr {
	text-align: center;
	vertical-align: middle;
}

table thead th{
	border: solid 1px white; 
	width: 3em;
	height: 2em;
	font-weight: 900;
  font-family: 'Josefin Sans', sans-serif;
}

table tbody td{
	border: solid 1px white;
	height: 2.7em;
}

a{
	text-decoration: none;
  font-family: 'Josefin Sans', sans-serif;
}

tbody a{
	display: block;
	height: 100%;
	display:flex;
	align-items: center;
	justify-content: center;
	color: black;
  
}


tsssssssssbody a:hover{
	background: #4371A7;
	color: white;
}

.null{
	color: gray;
  font-family: 'Josefin Sans', sans-serif;
}

.selectedBlue{
	background: blue;
	color:white;
}
.selectedRed{
	background: red;
	color:white;
}
.selectedSun{
	color:red;
}
.selectedHoli{
	background:green;
	color:#FFF;
}
.selectedEvent{
	background:#293;
	color:#FFF;
}

.selected a{
	color: white;
}

</style>";

					$data.='<table cellpadding="10"  width="100%">
                    <tr><td class="selectedBlue" >Leave</td>
                    <td class="selectedRed">Absent</td>
                    <td class="selectedHoli">Holiday</td>
                    <td class="selectedEvent">Event</td>
                    </table><br>';

$cnt=0;
$dy=array("Sun","Mon","Tue","Wed","Thu","Fri","Sat");
$mth=array(4,5,6,7,8,9,10,11,12,1,2,3);
$occDate='2019-04-1';
$stuid=	$adminid;
if($stuid=="" && $ses=="")
{
	exit;
}
	$response = array();
	$response["products"] = array();
	$product = array();

for($p=0;$p<count($mth);$p++)
	{
	 $thism= date('t',strtotime("$p month", strtotime($occDate)));
	 $date= date('d-m-Y',strtotime("$p month", strtotime($occDate)));
	 $d= date('D',strtotime("$p month", strtotime($occDate)));
 	 $mnth= date('M Y',strtotime("$p month", strtotime($occDate)));

	for($pp=0;$pp<7;$pp++)
		{
			if($dy[$pp]==$d){ $startDay=$pp; }
		}
//echo '<br><br>'.$startDay."=".$thism."=".$mnth."=".$date;
		 $data.=clndr($startDay,$thism,$mnth,$date,$dbh);
	}
	

	
function clndr($startDay,$thism,$mnth,$date,$dbh)
{	


$data.='<table summary="a calendar">

			<caption style="background:'.$adminbg.'">
				'.$mnth.' 
			</caption>

			<thead>
				<tr>
					<th scope="col" >Sun</th>
					<th scope="col">Mon</th>
					<th scope="col">Tue</th>
					<th scope="col">Wed</th>
					<th scope="col">Tur</th>
					<th scope="col">Fri</th>
					<th scope="col">Sat</th>
				</tr>
			</thead>

			<tbody>
<tr>';
$daynm=-$startDay;
	for($x=1;$x<=($thism+$startDay);$x++)
	{
		$daynm++;
			if($cnt>6){$data.='</tr><tr>'; $cnt=0;}
			$cnt++;
			if($daynm>0){
				$leave=0;
				$dts=date("Y-m-".$daynm,strtotime($date));
				$today=date("D",strtotime($dts));
						
			if($today=="Sun")
						{
							$leave=3;
						}else { 
							$leave= getATT2($dts,$dbh);
							if($leave=="")$leave =getHoli($dts,$dbh);			
						}
			//	echo '<br><br>=='.$today.' Dts='.$dts.' Leave ='.$leave;
			
				switch($leave)
				{
				case 0:
					$data.='<td><a href="#">'.$daynm.'</a></td>';
				break; 	
				case 1:
					$data.='<td class="selectedBlue"><a href="#" style="color:white">'.$daynm.'</a></td>';
				break; 	
				case 2:
					$data.='<td class="selectedRed"><a href="#" style="color:white">'.$daynm.'</a></td>';
				break; 	
				case 3:
					$data.='<td class="selectedSun"><a href="#" style="color:red">'.$daynm.'</a></td>';
				break; 	
				case 4:
					$data.='<td class="selectedHoli"><a href="#">'.$daynm.'</a></td>';
				break; 	
				case 5:
					$data.='<td class="selectedEvent"><a href="#">'.$daynm.'</a></td>';
				break; 	
					
				}	
				
					}else {
					$data.='<td  class="null"></td>';
	
						}
			}
$data.='</table><br>';
return $data;
}	

function getHoli($date,$dbh)
{
	$sql="Select * from holi WHERE DATE1='".$date."'";
				foreach ($dbh->query($sql) as $row)
		        	{
					if($row['EVENT']=='Holiday')
					$get=4;
					else
					$get=5;

					}
return $get;
}

function getATT2($date,$dbh)
{
	global $stuid;
	$cl=findnm("stu_info","CLS"," WHERE ID=".$stuid."",$dbh);
	$sql="Select * from stu_attendence WHERE DATE='".$date."' AND CID=".$cl." order by ID ASC";
	//echo '<br>'.$sql;
				foreach ($dbh->query($sql) as $row)
		        	{
						$att=explode(",",$row['ATT']);
						$sid=explode(",",$row['STUID']);
						$sidfound= array_search($stuid,$sid);
						//echo '<br>======>'.$sidfound;

						if($sidfound>=0)$get= $att[$sidfound]; else $get="";
					//	echo '<br>'.$stuid;
					//	print_r($att);
					//	echo '<br>';
					//	print_r($sid);
					//	echo '<br>'.$get.'======>'.$sidfound;
					
					}
return $get;
}


		?>

