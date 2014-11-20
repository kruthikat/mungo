<?php
/**
 * Template Name: Doctor Appointments
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header();  ?>

<style type="text/css">

.main
{
	margin:auto;
    width:960px;
	height:auto;
	font-family:"harrypotter7";
	background-color:rgb(239,237,237);
	font-size:20px;
	border:1px thin black;
	scroll:no-scroll;
}
.main1
{
	
    width:210px;
	height:12%;
	font-family:"harrypotter7";
	padding-left:40px;
	font-size:75;
	color:rgb(1,177,214);
	border:1px thin black;
	scroll:no-scroll;
}
.Smain1
{	
	position:relative;
	left:220px;
	top:-75px;
    width:640px;
	height:80px;
	font-family:"harrypotter7";
	padding-left:40px;
	font-size:40;
	color:rgb(129,129,129);
	border:1px thin black;
	scroll:no-scroll;
}
.menu
{
	margin-left:-10px;
   	width:964px;;
	position:absolute;
	height:2;
	padding:0px;
	spacing:2px;
  	
}

.menu ul
{	width:964px;
	margin-top:0px;
	margin-left:-29px;
    line-height:10px;
	left-pading:6px;
	spacing:3px;
	font-family:"Monotype Corsiva";
}

.menu li
{ 
	margin-left:0px;	
    padding:6px;
	spacing:5px;
	width:178px; 
   	list-style:none;
	border-right:2px solid white;
    float:left;
   	font-family:"Monotype Corsiva";
   	background:rgb(129,129,129);
}

.menu li a
{
	margin-left:0px;	
	padding:3px;
	text-align:center; 
    height:15px;
   	width:174px; 
   	display:block;
    color:rgb(129,129,129); 
	font-size:18px;
	font-family:"gabriola";
    text-decoration:none;
    color:#FFF;     
}
.menu li a:hover
{
	color:BLACK;
}
.wh1
{	top:220px;
	left:150px;
	width:576px;
	height:332px;
	background-image:url(right.jpg);
	border-bottom-width: medium;
}

.loginp1
{	position:absolute;
	left:800px;
	margin-top:15px;
	width:290px;
	padding-left:10px;
	font-family:"harrypotter7";
	font-size:12px;
}
.cb2
{
	height:auto;
	margin:40px;
	width:240px;
	padding:30px;

	font-family:"gabriola";
		
	padding-left:10px;
}

.button
{
text-decoration:none; text-align:center; 
 padding:9px 25px; 
 border:none; 
 -webkit-border-radius:25px 4px 25px 4px; 	 				 border-radius: 25px 4px 25px 4px; 					-moz-border-radius-topleft:25px; 					-moz-border-radius-topright:4px; 					-moz-border-radius-bottomleft:4px; 					-moz-border-radius-bottomright:25px;  
 font:13px harrypotter7, LumosLatino, sans-serif; 
 font-weight:bold; 
 color:white; 
 background-color:rgb(129,129,129); 
 background-image: -moz-linear-gradient(top, rgb(129,129,129) 0%, rgb(129,129,129) 100%); 
 background-image: -webkit-linear-gradient(top, rgb(129,129,129) 0%, rgb(129,129,129) 100%); 
 background-image: -o-linear-gradient(top, rgb(129,129,129) 0%, rgb(129,129,129) 100%); 
 background-image: -ms-linear-gradient(top, rgb(129,129,129) 0% ,rgb(129,129,129) 100%); 
 filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#2d93b5', endColorstr='#2d93b5',GradientType=0 ); 
 background-image: linear-gradient(top, #1e8bb0 0% ,#2d93b5 100%);   
 -webkit-box-shadow:inset 0,0,0px 0,0,0px 17,1,4px #ffffff,#ffffff,#ffffff;  -moz-box-shadow:inset 0px 0px 17px #ffffff;  box-shadow:inset 0px 0px 17px #ffffff;  
  
 text-shadow: -1px 0px 0px #524c4c; 
 filter: dropshadow(color=#524c4c, offx=-1, offy=0);  -webkit-transition: all 0.18s linear;
 -moz-transition:  all 0.18s linear;
 -o-transition:  all 0.18s linear;
 transition:  all 0.18s linear;}
 
 .button:hover{
 padding:10px 10px; 
 margin-left: 20px;
 -webkit-border-radius:25px 4px 25px 4px; 	 				 border-radius: 25px 4px 25px 4px; 					-moz-border-radius-topleft:25px; 					-moz-border-radius-topright:4px; 					-moz-border-radius-bottomleft:4px; 					-moz-border-radius-bottomright:25px;  
 font:13px harrypotter7, LumosLatino, sans-serif 
 font-weight:bold; 
 color:#dae6e6; 
 background-color:#3ba4c7; 
 background-image: -moz-linear-gradient(top, #3ba4c7 0%, #1982a5 100%); 
 background-image: -webkit-linear-gradient(top, #3ba4c7 0%, #1982a5 100%); 
 background-image: -o-linear-gradient(top, #3ba4c7 0%, #1982a5 100%); 
 background-image: -ms-linear-gradient(top, #3ba4c7 0% ,#1982a5 100%); 
 filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#1982a5', endColorstr='#1982a5',GradientType=0 ); 
 background-image: linear-gradient(top, #3ba4c7 0% ,#1982a5 100%);   
 -webkit-box-shadow:0px 0px 2px #bababa, inset 0px 0px 1px #ffffff; 
 -moz-box-shadow: 0px 0px 2px #bababa,  inset 0px 0px 1px #ffffff;  
 box-shadow:0px 0px 2px #bababa, inset 0px 0px 1px #ffffff;  
  
 }
 
 .button:active{
 padding:9px 45px; 
 
 -webkit-border-radius:25px 4px 25px 4px; 	 				 border-radius: 25px 4px 25px 4px; 					-moz-border-radius-topleft:25px; 					-moz-border-radius-topright:4px; 					-moz-border-radius-bottomleft:4px; 					-moz-border-radius-bottomright:25px;  
 font:12px harrypotter7, LumosLatino, sans-serif 
 font-weight:bold; 
 color:#e5ffff; 
 background-color:#3BA4C7; 
 background-image: -moz-linear-gradient(top, #3BA4C7 0%, #1982A5 100%); 
 background-image: -webkit-linear-gradient(top, #3BA4C7 0%, #1982A5 100%); 
 background-image: -o-linear-gradient(top, #3BA4C7 0%, #1982A5 100%); 
 background-image: -ms-linear-gradient(top, #3BA4C7 0% ,#1982A5 100%); 
 filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#1982A5', endColorstr='#1982A5',GradientType=0 ); 
 background-image: linear-gradient(top, #3BA4C7 0% ,#1982A5 100%);   
 -webkit-box-shadow:0px 0px 2px #bababa, inset 0px 0px 4px #ffffff; 
 -moz-box-shadow: 0px 0px 2px #bababa,  inset 0px 0px 4px #ffffff;  
 box-shadow:0px 0px 2px #bababa, inset 0px 0px 4px #ffffff;  
  
 }
 
 tr {
	height: 50px;
 }
 td > input {
	width: 100%;
	}
 p
 {
	
 }

</style >

<body>
	<div class="main">
		<div class="main1">
				SMH		
		
		<div class="Smain1">
				St.Mungo's Hospital</br>
				<Font size=3> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;for magical maladies and injuries
			</div>
		</div>
		</br>
		<div class="menu" >
			<ul >
				<li><a href="login.jsp">HOME </a></li>
				<li><a href="news.jsp">NEWSLETTER </a></li>
				<li><a href="tc.jsp">TERMS* </a></li>
				<li><a href="contactus.jsp">CONTACT US</a></li>
				<li><a href="">HELPDESK </a></li>
			</ul>
		</div>
		<p>
			
			</br></br>
			
<!--			<div class="cb2"> 
				<table colspan=1>
					<tr><td><input class="button" type="button" value="View all appointments"></input></tr></td>
					<tr><td><input class="button" type="button" value="Edit treatment details"></input></tr></td>
					<tr><td><input class="button" type="button" value="Edit profile"></input></tr></td>
					
					
				</table>
			</div> -->
			<?php
				
				global $wpdb;
				$users = $wpdb->prefix."hpusers";
				$treats = $wpdb->prefix."treats";
				$treatments = $wpdb->prefix."treatments";
				$res = $wpdb->get_results("SELECT T.patient_id P, U.name N, T2.apt_date A
				FROM 	$treats T, $users U, $treatments T2
				WHERE 	T.doctor_id = 'Anderson1'
				AND 	T.bill_no = T2.bill_no
				AND 	T.patient_id = U.userid");

				echo "Number of Results: ";
				echo $wpdb->num_rows;
				echo "<style> table, th, td {border: 1px solid black; font: harrypotter7, LumosLatino, sans-serif} </style>"; 
				echo "<table>";
				echo "<th> Patient Name </th>";
				echo "<th> Appointment Date </th>";
				echo "<th> Patient's Userid</th>";
				foreach ($res as $t_res) {
					echo "<tr>";
//					echo "<td>"; echo $t_res->N; echo "</td>";
//					echo "<td>"; echo $t_res->A; echo "</td>";
//					echo "<td>"; echo $t_res->P; echo "</td>";
//					echo "</tr>";
					echo "<td> $t_res->N </td>";
					echo "<td> $t_res->A </td>";
					echo "<td> $t_res->P </td>";
					echo "</tr>";
				}
				echo "</table>";
			?>
		</p>	
	</div>
</body>
</html>