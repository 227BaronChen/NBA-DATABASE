<!DOCTYPE html>
<html>
<head>
  <meta charset = "utf-8">
  <title>Team System</title>
  
  <style>
  #header {
    background-color:#FF0099;
    color:white;
    text-align:center;
    padding:7px;
  }
  
  #nav {
	  line-height:30px;
	  background-color:#FF9999;
	  height:1000px;
	  width:20%;
	  float:left;
	  padding:10px;
  }
  
  #section {
	  width:77%;
	  float:right;
	  padding:10px;
  }
  
  </style>
  <?php
  $server = "127.0.0.1";        
  $dbuser = "root";       
  $dbpassword = "123456"; 
  $dbname = "team_project";  
  $connection = new mysqli($server, $dbuser, $dbpassword, $dbname);
  if($connection -> connect_error)
  {
    printf("connection failed");
  }
  ?>
</head>
<body>
  <div id="header">
  <h1>NBA Teams' Stats Since 1950</h1>
  </div>
  
  <div id="nav">
  <font size="4">Please Select Team , Statistic And Years</br></br></font>
<form method="post" action="Team.php">
  <label for="Team">Team:</label>
  <input type="text" name = "team" value = GSW size="4">
  </br>
  </br>
  <label for="statistic">Statistic:</label>
  <select name="statistic">
　  <option value="FGM">Total Field Goal Made</option>
　  <option value="FGA">Total Field Goal Attempt</option>
　  <option value="Field_Goal_Percentage">Average Field Goal Percentage</option>
　  <option value="Three_Point_Made">Total Three Point Made</option>
　  <option value="Three_Point_Attempt">Total Three Point Attempt</option>
　  <option value="Three_Point_Percentage">Average Three Point Percentage</option>
　  <option value="Two_Point_Made">Total Two Point Made</option>
　  <option value="Two_Point_Attempt">Total Two Point Attempt</option>
　  <option value="Two_Point_Percentage">Average Two Point Percentage</option>
　  <option value="Effective_Field_Goal_Percentage">Average Effective Field Goal Percentage</option>
　  <option value="Free_Throw_Made">Total Free Throw</option>
　  <option value="Free_Throw_Attempt">Total Free Throw Attempt</option>
　  <option value="Free_Throw_Percentage">Average Free Throw Percentage</option>
　  <option value="Offensive_Rebound">Total Offensive Rebound</option>
　  <option value="Defensive_Rebound">Total Defensive Rebound</option>
　  <option value="Total_Rebound">Total Rebound</option>
　  <option value="Assist">Total Assist</option>
　  <option value="Steal">Total Steal</option>
　  <option value="Block">Total Block</option>
　  <option value="Turnover">Total Turnover</option>
　  <option value="Personal_Foul">Total Personal Foul</option>
　  <option value="Point">Total Points</option>
  </select>
  </br>
  </br>
  <label for="years">Years: From</label>
  <input type="text" name = "beginyear" value = 1972 size="4">
  <label for="years">to</label>
  <input type="text" name = "endyear" value = 2020 size="4">
  </br>
  </br>
  <input type="submit" value="Submit!">
  </br>
  </br>
</form>
<button onclick="location.href='Homepage.php'">Back to Home page</button>
</div>

<div id="section">
<?php
error_reporting(E_ERROR);
if($_POST['team']!='')
{
  $team = $_POST['team'];
  $statistic = $_POST['statistic'];
  $beginyear = $_POST['beginyear'];
  $endyear = $_POST['endyear'];
  if($statistic == "Field_Goal_Percentage" | $statistic == "Three_Point_Percentage" | $statistic == "Two_Point_Percentage" | $statistic == "Effective_Field_Goal_Percentage" | $statistic == "Free_Throw_Percentage")
  {
    $sqlquery = "SELECT round(avg($statistic) , 3) , Year FROM Player_Statistics_Per_Game WHERE Team = '$team' AND Year >= $beginyear AND Year <= $endyear GROUP BY Year ORDER BY Year;";
    $result = $connection -> query($sqlquery);
    if($result -> num_rows > 0)
    {
      echo "<b>$team's $statistic stats from $beginyear to $endyear:</br></br></b>";
      echo '<table border = "1">';
      echo "<tr><th>$statistic</th><th>Year</th></tr>";
      while($row = $result -> fetch_row())
      {
        echo "<tr>";
        for($i=0;$i<2;$i++)
        {
          echo "<td align='right'>$row[$i]</td>";
        }
        echo "</tr>";
      }
      $result -> free_result();
    }
    else 
    {
      echo "No such team found!"; 
    }
  }
  else
  {
    $sqlquery = "SELECT round(sum($statistic * Game_Played) , 0) , Year FROM Player_Statistics_Per_Game WHERE Team = '$team' AND Year >= $beginyear AND Year <= $endyear GROUP BY Year ORDER BY Year;";
    $result = $connection -> query($sqlquery);
    if($result -> num_rows > 0)
    {
      echo "<b>$team's $statistic stats from $beginyear to $endyear:</br></br></b>";
      echo '<table border = "1">';
      echo "<tr><th>$statistic</th><th>Year</th></tr>";
      while($row = $result -> fetch_row())
      {
        echo "<tr>";
        for($i=0;$i<2;$i++)
        {
          echo "<td align='right'>$row[$i]</td>";
          if($i==0)$statistics[]=intval($row[$i]);
          else$years[]=intval($row[$i]);
        }
        echo "</tr>";
      }
      $result -> free_result();
    }
    else 
    {
      echo "No such team found!"; 
    }
  }
}
else
{
  echo "Please input your team";
}
$connection->close();
?>
</div>
</body>
</html>