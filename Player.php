</option><!DOCTYPE html>
<html>
<head>
  <meta charset = "utf-8">
  <title>Player System</title>
  
  <style>
  #header {
    background-color:black;
    color:white;
    text-align:center;
    padding:7px;
  }
  
  #nav {
      line-height:30px;
      background-color:#eeeeee;
      height:1000px;
      width:20%;
      float:left;
      padding:5px;
  }
  
  #section {
      width:75%;
      padding:10px;
	  float:right;
  }
  
  #section1 {
	  width:42%;
	  height:70%;
	  float:right;
	  padding:10px;
	  background-color:#FFCCCC;
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
  <h1>NBA Players Stats Since 1950</h1>
  </div>
  <!--
  <h1>Database Final Project</h1>
  <h2>NBA Players Stats Since 1950</h2>
  -->
  <div id="nav">
    <font size="3">1. Input Player's Name</br></font>
    <font size="3">2. Select Team</br></font>
    <font size="3">3. Select Stats Type(required)</br></font>
    <font size="3">4. Input the Year Queried</br></font>
    <font size="3">(At least choose one from 1 and 2)</br></font><hr />
  <form method="post" action="Player.php">
    <label for="Name">Player's Name:</label>
    <input type="text" name="player"></br>
    <label for="Team">Team:</label>
    <select name="team">
      <option value=""></option>
      <option value="ATL">ATL</option>
      <option value="BAL">BAL</option>
      <option value="BLB">BLB</option> 
      <option value="BOS">BOS</option>
      <option value="BRK">BRK</option>
      <option value="BUF">BUF</option>
      <option value="CAP">CAP</option>
      <option value="CHA">CHA</option>
      <option value="CHH">CHH</option>
      <option value="CHI">CHI</option>
      <option value="CHO">CHO</option>
      <option value="CHP">CHP</option>
      <option value="CHZ">CHZ</option>
      <option value="CIN">CIN</option>
      <option value="CLE">CLE</option>
      <option value="DAL">DAL</option>
      <option value="DEN">DEN</option>
      <option value="DET">DET</option>
      <option value="FTW">FTW</option>
      <option value="GSW">GSW</option>
      <option value="HOU">HOU</option>
      <option value="IND">IND</option>
      <option value="INO">INO</option>
      <option value="KCK">KCK</option>
      <option value="KCO">KCO</option>
      <option value="LAC">LAC</option>
      <option value="LAL">LAL</option>
      <option value="MEM">MEM</option>
      <option value="MIA">MIA</option>
      <option value="MIL">MIL</option>
      <option value="MIN">MIN</option>
      <option value="MLH">MLH</option>
      <option value="MNL">MNL</option>
      <option value="NJN">NJN</option>
      <option value="NOH">NOH</option>
      <option value="NOJ">NOJ</option>
      <option value="NOK">NOK</option>
      <option value="NOP">NOP</option>
      <option value="NYK">NYK</option>
      <option value="NYN">NYN</option>
      <option value="OKC">OKC</option>
      <option value="ORL">ORL</option>
      <option value="PHI">PHI</option>
      <option value="PHO">PHO</option>
      <option value="PHW">PHW</option>
      <option value="POR">POR</option>
      <option value="ROC">ROC</option>
      <option value="SAC">SAC</option>
      <option value="SAS">SAS</option>
      <option value="SDC">SDC</option>
      <option value="SDR">SDR</option>
      <option value="SEA">SEA</option>
      <option value="SFW">SFW</option>
      <option value="STL">STL</option>
      <option value="SYR">SYR</option>
      <option value="TOR">TOR</option>
      <option value="TOT">TOT</option>
      <option value="TRI">TRI</option>
      <option value="UTA">UTA</option>
      <option value="VAN">VAN</option>
      <option value="WAS">WAS</option>
      <option value="WSB">WSB</option>
      <option value="WSC">WSC</option>
    </select></br>
    <label for="Type">Stats Type</label>
    <select name="type">
      <option value=""> </option>
      <option value="basic">Basic Stats</option>
      <option value="offensive">Offensive Stats</option>
      <option value="defensive">Defensive Stats</option>
      <option value="advanced">Advenced Stats</option>
    </select></br>
    <label for="Year">Year:</label>
    <input type="text" name="year"></br></br>
  <input type="submit" value="submit"></br>
  </form>
  <button onclick="location.href='Homepage.php'" style="text-align:right">Back to Home page</button>
  </div>

<div id="section">
<?php
error_reporting(E_ERROR);
include 'graph.php';
delfile('./opt_jpg/1.jpg');
delfile('./opt_jpg/2.jpg');
if($_POST['year']=='')  # 如果年份为空
{
  if(($_POST['player']!='')&&($_POST['type']!=''))  # 如果name和type非空
  {
    $player = $_POST['player'];
    $team = $_POST['team'];
    $type = $_POST['type'];
    if($team != '') # 如果team非空
    {
      if($type == 'basic')
      {
        $sqlquery = "SELECT Player, Position, Age, Year, Team, Point, Total_Rebound, Assist, Steal, Field_Goal_Percentage, Three_Point_Percentage
                      FROM Player_Statistics_Per_Game 
                      WHERE (Player LIKE '$player %' or Player LIKE '% $player' or Player = '$player') and Team = '$team'
                      ORDER BY Player, Age ASC;";
        $result = $connection->query($sqlquery);
        if($result -> num_rows > 0) # 如果查询结果非空
        {
          echo "$team's $player's Basic Stats:</br>";
          echo '<table border = "1">';
          echo "<tr><th>Player<th>Position<th>Age<th>Year<th>Team<th>Point<th>Total_Rebound<th>Assist<th>
          Steal<th>FG%<th>3PT%</th></tr>";  # 表头
          while($row = $result -> fetch_row())  # 逐行输出
          {
            echo "<tr>";
            for($i=0;$i<11;$i++)    # 11列
            {
              echo "<td align='right'>$row[$i]</td>";
            }
            echo "</tr>";
          }
          $result -> free_result();
        }
      }
      else if($type == 'offensive')
      {
        $sqlquery = "SELECT Player, Position, Age, Year, Team, Point, Assist, Field_Goal_Percentage, Two_Point_Percentage,
                      Three_Point_Percentage, Free_Throw_Percentage FROM Player_Statistics_Per_Game 
                      WHERE (Player LIKE '$player %' or Player LIKE '% $player' or Player = '$player') and Team = '$team'
                      ORDER BY Player, Age ASC;";
        $result = $connection->query($sqlquery);
        if($result -> num_rows > 0)
        {
          echo "$team's $player's Offensive Stats:</br>";
          echo '<table border = "1">';
          echo "<tr><th>Player<th>Position<th>Age<th>Year<th>Team<th>Point<th>Assist<th>FG%<th>
          2PT%<th>3PT%<th>FT%</th></tr>";
          while($row = $result -> fetch_row())
          {
            echo "<tr>";
            for($i=0;$i<11;$i++)
            {
              echo "<td align='right'>$row[$i]</td>";
            }
            echo "</tr>";
          }
          $result -> free_result();
        }
      }
      else if($type == 'defensive')
      {
        $sqlquery = "SELECT Player, Position, Age, Year, Team, Total_Rebound, Steal, Block FROM Player_Statistics_Per_Game 
                      WHERE (Player LIKE '$player %' or Player LIKE '% $player' or Player = '$player') and Team = '$team' 
                      ORDER BY Player, Age ASC;";
        $result = $connection->query($sqlquery);
        if($result -> num_rows > 0)
        {
          echo "$team's $player's Defensive Stats:</br>";
          echo '<table border = "1">';
          echo "<tr><th>Player<th>Position<th>Age<th>Year<th>Team<th>Rebound<th>Steal<th>Block</th></tr>";
          while($row = $result -> fetch_row())
          {
            echo "<tr>";
            for($i=0;$i<8;$i++)
            {
              echo "<td align='right'>$row[$i]</td>";
            }
            echo "</tr>";
          }
          $result -> free_result();
        }
      }
      else if($type == 'advanced')
      {
        $sqlquery = "SELECT * FROM Player_Statistics_Per_Game 
                      WHERE (Player LIKE '$player %' or Player LIKE '% $player' or Player = '$player') and Team = '$team'
                      ORDER BY Player, Age ASC;";
        $result = $connection -> query($sqlquery);
        if($result -> num_rows > 0)
        {
          echo "$team's $player's Advanced Stats:</br>";
          echo '<table border = "1">';
          echo "<tr><th>Player<th>Position<th>Age<th>Team<th>Game Played<th>Game Started<th>Average Time<th>FGM
          <th>FGA<th>FG%<th>3PTM<th>3PT<th>3PT<th>2PTM<th>2PTA<th>2PT%<th>EFG%<th>FTM<th>FTA<th>FT%<th>Offensive Rebound
          <th>Defensive Rebound<th>Turnove<th>Assist<th>Stea<th>Block<th>Turnover<th>Personal Foul<th>Point<th>year</tr>";
          while($row = $result -> fetch_row())
          {
            echo "<tr>";
            for($i=0;$i<30;$i++)
            {
              echo "<td align='right'>$row[$i]</td>";
            }
            echo "</tr>";
          }
          $result -> free_result();
        }
      }
    }
    else    # team为空
    {
      if($type == 'basic')
      {
        $sqlquery = "SELECT Player, Position, Age, Year, Team, Point, Total_Rebound, Assist, Steal, Field_Goal_Percentage, Three_Point_Percentage
                      FROM Player_Statistics_Per_Game 
                      WHERE Player LIKE '$player %' or Player LIKE '% $player' or Player = '$player'
                      ORDER BY Player, Age ASC;";
        $result = $connection->query($sqlquery);
        if($result -> num_rows > 0)
        {
          echo "$player's Basic Stats:</br>";
          echo '<table border = "1">';
          echo "<tr><th>Player<th>Position<th>Age<th>Year<th>Team<th>Point<th>Total_Rebound<th>Assist<th>
          Steal<th>FG%<th>3PT%</th></tr>";
          while($row = $result -> fetch_row())
          {
            echo "<tr>";
            for($i=0;$i<11;$i++)
            {
              echo "<td align='right'>$row[$i]</td>";
            }
            echo "</tr>";
          }
          $result -> free_result();
        }
      }
      else if($type == 'offensive')
      {
        $sqlquery = "SELECT Player, Position, Age, Year, Team, Point, Assist, Field_Goal_Percentage, Two_Point_Percentage,
                      Three_Point_Percentage, Free_Throw_Percentage FROM Player_Statistics_Per_Game 
                      WHERE (Player LIKE '$player %' or Player LIKE '% $player' or Player = '$player')
                      ORDER BY Player, Age ASC;";
        $result = $connection->query($sqlquery);
        if($result -> num_rows > 0)
        {
          echo "$player's Offensive Stats:</br>";
          echo '<table border = "1">';
          echo "<tr><th>Player<th>Position<th>Age<th>Year<th>Team<th>Point<th>Assist<th>FG%<th>
          2PT%<th>3PT%<th>FT%</th></tr>";
          while($row = $result -> fetch_row())
          {
            echo "<tr>";
            for($i=0;$i<11;$i++)
            {
              echo "<td align='right'>$row[$i]</td>";
            }
            echo "</tr>";
          }
          $result -> free_result();
        }
      }
      else if($type == 'defensive')
      {
        $sqlquery = "SELECT Player, Position, Age, Year, Team, Total_Rebound, Steal, Block FROM Player_Statistics_Per_Game 
                      WHERE (Player LIKE '$player %' or Player LIKE '% $player' or Player = '$player')
                      ORDER BY Player, Age ASC;";
        $result = $connection->query($sqlquery);
        if($result -> num_rows > 0)
        {
          echo "$player's Defensive Stats:</br>";
          echo '<table border = "1">';
          echo "<tr><th>Player<th>Position<th>Age<th>Year<th>Team<th>Rebound<th>Steal<th>Block</th></tr>";
          while($row = $result -> fetch_row())
          {
            echo "<tr>";
            for($i=0;$i<8;$i++)
            {
              echo "<td align='right'>$row[$i]</td>";
            }
            echo "</tr>";
          }
          $result -> free_result();
        }
      }
      else if($type == 'advanced')
      {
        $sqlquery = "SELECT * FROM Player_Statistics_Per_Game             
                      WHERE (Player LIKE '$player %' or Player LIKE '% $player' or Player = '$player')
                      ORDER BY Player, Age ASC;";
        $result = $connection -> query($sqlquery);
        if($result -> num_rows >= 0)
        {
          echo "$player's Advanced Stats:</br>";
          echo '<table border = "1">';
          echo "<tr><th>Player<th>Position<th>Age<th>Team<th>Game Played<th>Game Started<th>Average Time<th>FGM
          <th>FGA<th>FG%<th>3PTM<th>3PT<th>3PT<th>2PTM<th>2PTA<th>2PT%<th>EFG%<th>FTM<th>FTA<th>FT%<th>Offensive Rebound
          <th>Defensive Rebound<th>Turnove<th>Assist<th>Stea<th>Block<th>Turnover<th>Personal Foul<th>Point<th>year</tr>";
          while($row = $result -> fetch_row())
          {
            echo "<tr>";
            for($i=0;$i<30;$i++)
            {
              echo "<td align='right'>$row[$i]</td>";
            }
            echo "</tr>";
          }
          $result -> free_result();
        }
      }
    }
  }
  else if(($_POST['player']=='')&&$_POST['type']!='')   # 如果name为空，type非空
  {
    $team = $_POST['team'];
    $type = $_POST['type'];
    if($team != '') # 如果team非空
    {
      if($type == 'basic')
      {
        $sqlquery = "SELECT Player, Position, Age, Year, Team, Point, Total_Rebound, Assist, Steal, Field_Goal_Percentage, Three_Point_Percentage
                      FROM Player_Statistics_Per_Game WHERE Team = '$team'
                      ORDER BY Player, Age ASC;";
        $result = $connection->query($sqlquery);
        if($result -> num_rows > 0)
        {
          echo "$team's Players' Basic Stats:</br>";
          echo '<table border = "1">';
          echo "<tr><th>Player<th>Position<th>Age<th>Year<th>Team<th>Point<th>Total_Rebound<th>Assist<th>
          Steal<th>FG%<th>3PT%</th></tr>";
          while($row = $result -> fetch_row())
          {
            echo "<tr>";
            for($i=0;$i<11;$i++)
            {
              echo "<td align='right'>$row[$i]</td>";
            }
            echo "</tr>";
          }
          $result -> free_result();
        }
      }
      else if($type == 'offensive')
      {
        $sqlquery = "SELECT Player, Position, Age, Year, Team, Point, Assist, Field_Goal_Percentage, Two_Point_Percentage,
                      Three_Point_Percentage, Free_Throw_Percentage 
                      FROM Player_Statistics_Per_Game WHERE Team = '$team'
                      ORDER BY Player, Age ASC;";
        $result = $connection->query($sqlquery);
        if($result -> num_rows > 0)
        {
          echo "$team's Players' Offensive Stats:</br>";
          echo '<table border = "1">';
          echo "<tr><th>Player<th>Position<th>Age<th>Year<th>Team<th>Point<th>Assist<th>FG%<th>
          2PT%<th>3PT%<th>FT%</th></tr>";
          while($row = $result -> fetch_row())
          {
            echo "<tr>";
            for($i=0;$i<11;$i++)
            {
              echo "<td align='right'>$row[$i]</td>";
            }
            echo "</tr>";
          }
          $result -> free_result();
        }
      }
      else if($type == 'defensive')
      {
        $sqlquery = "SELECT Player, Position, Age, Year, Team, Total_Rebound, Steal, Block 
                      FROM Player_Statistics_Per_Game WHERE Team = '$team'
                      ORDER BY Player, Age ASC;";
        $result = $connection->query($sqlquery);
        if($result -> num_rows > 0)
        {
          echo "$team's Players' Defensive Stats:</br>";
          echo '<table border = "1">';
          echo "<tr><th>Player<th>Position<th>Age<th>Year<th>Team<th>Rebound<th>Steal<th>Block</th></tr>";
          while($row = $result -> fetch_row())
          {
            echo "<tr>";
            for($i=0;$i<8;$i++)
            {
              echo "<td align='right'>$row[$i]</td>";
            }
            echo "</tr>";
          }
          $result -> free_result();
        }
      }
      else if($type == 'advanced')
      {
        $sqlquery = "SELECT * FROM Player_Statistics_Per_Game WHERE Team = '$team'
                      ORDER BY Player, Age ASC;";
        $result = $connection -> query($sqlquery);
        if($result -> num_rows > 0)
        {
          echo "$team's Players' Advanced Stats:</br>";
          echo '<table border = "1">';
          echo "<tr><th>Player<th>Position<th>Age<th>Team<th>Game Played<th>Game Started<th>Average Time<th>FGM
          <th>FGA<th>FG%<th>3PTM<th>3PT<th>3PT<th>2PTM<th>2PTA<th>2PT%<th>EFG%<th>FTM<th>FTA<th>FT%<th>Offensive Rebound
          <th>Defensive Rebound<th>Turnove<th>Assist<th>Stea<th>Block<th>Turnover<th>Personal Foul<th>Point<th>year</tr>";
          while($row = $result -> fetch_row())
          {
            echo "<tr>";
            for($i=0;$i<30;$i++)
            {
              echo "<td align='right'>$row[$i]</td>";
            }
            echo "</tr>";
          }
          $result -> free_result();
        }
      }
    }
  }
}
else
{
  $year=$_POST['year'];
  if(($_POST['player']!='')&&($_POST['type']!=''))  # 如果name和type非空
  {
    $player = $_POST['player'];
    $team = $_POST['team'];
    $type = $_POST['type'];
    if($team != '') # 如果team非空
    {
      if($type == 'basic')
      {
        $sqlquery = "SELECT Player, Position, Age, Year, Team, Point, Total_Rebound, Assist, Steal, Field_Goal_Percentage, Three_Point_Percentage
                      FROM Player_Statistics_Per_Game 
                      WHERE (Player LIKE '$player %' or Player LIKE '% $player' or Player = '$player') and Team = '$team' and Year = '$year'
                      ORDER BY Player, Age ASC;";
        $result = $connection->query($sqlquery);
        if($result -> num_rows > 0) # 如果查询结果非空
        {
          echo "$team's $player's Basic Stats:</br>";
          echo '<table border = "1">';
          echo "<tr><th>Player<th>Position<th>Age<th>Year<th>Team<th>Point<th>Total_Rebound<th>Assist<th>
          Steal<th>FG%<th>3PT%</th></tr>";  # 表头
          while($row = $result -> fetch_row())  # 逐行输出
          {
            echo "<tr>";
            for($i=0;$i<11;$i++)    # 11列
            {
              echo "<td align='right'>$row[$i]</td>";
            }
            echo "</tr>";
          }
          $result -> free_result();
        }
      }
      else if($type == 'offensive')
      {
        $sqlquery = "SELECT Player, Position, Age, Year, Team, Point, Assist, Field_Goal_Percentage, Two_Point_Percentage,
                      Three_Point_Percentage, Free_Throw_Percentage FROM Player_Statistics_Per_Game 
                      WHERE (Player LIKE '$player %' or Player LIKE '% $player' or Player = '$player') and Team = '$team' and Year = '$year'
                      ORDER BY Player, Age ASC;";
        $result = $connection->query($sqlquery);
        if($result -> num_rows > 0)
        {
          echo "$team's $player's Offensive Stats:</br>";
          echo '<table border = "1">';
          echo "<tr><th>Player<th>Position<th>Age<th>Year<th>Team<th>Point<th>Assist<th>FG%<th>
          2PT%<th>3PT%<th>FT%</th></tr>";
          while($row = $result -> fetch_row())
          {
            echo "<tr>";
            for($i=0;$i<11;$i++)
            {
              echo "<td align='right'>$row[$i]</td>";
            }
            echo "</tr>";
          }
          $result -> free_result();
        }
      }
      else if($type == 'defensive')
      {
        $sqlquery = "SELECT Player, Position, Age, Year, Team, Total_Rebound, Steal, Block FROM Player_Statistics_Per_Game 
                      WHERE (Player LIKE '$player %' or Player LIKE '% $player' or Player = '$player') and Team = '$team' and Year = '$year'
                      ORDER BY Player, Age ASC;";
        $result = $connection->query($sqlquery);
        if($result -> num_rows > 0)
        {
          echo "$team's $player's Defensive Stats:</br>";
          echo '<table border = "1">';
          echo "<tr><th>Player<th>Position<th>Age<th>Year<th>Team<th>Rebound<th>Steal<th>Block</th></tr>";
          while($row = $result -> fetch_row())
          {
            echo "<tr>";
            for($i=0;$i<8;$i++)
            {
              echo "<td align='right'>$row[$i]</td>";
            }
            echo "</tr>";
          }
          $result -> free_result();
        }
      }
      else if($type == 'advanced')
      {
        $sqlquery = "SELECT * FROM Player_Statistics_Per_Game 
                      WHERE (Player LIKE '$player %' or Player LIKE '% $player' or Player = '$player') and Team = '$team' and Year = '$year'
                      ORDER BY Player, Age ASC;";
        $result = $connection -> query($sqlquery);
        if($result -> num_rows > 0)
        {
          echo "$team's $player's Advanced Stats:</br>";
          echo '<table border = "1">';
          echo "<tr><th>Player<th>Position<th>Age<th>Team<th>Game Played<th>Game Started<th>Average Time<th>FGM
          <th>FGA<th>FG%<th>3PTM<th>3PT<th>3PT<th>2PTM<th>2PTA<th>2PT%<th>EFG%<th>FTM<th>FTA<th>FT%<th>Offensive Rebound
          <th>Defensive Rebound<th>Turnove<th>Assist<th>Stea<th>Block<th>Turnover<th>Personal Foul<th>Point<th>year</tr>";
          while($row = $result -> fetch_row())
          {
            echo "<tr>";
            for($i=0;$i<30;$i++)
            {
              echo "<td align='right'>$row[$i]</td>";
            }
            echo "</tr>";
          }
          $result -> free_result();
        }
      }
    }
    else    # team为空
    {
      if($type == 'basic')
      {
        $sqlquery = "SELECT Player, Position, Age, Year, Team, Point, Total_Rebound, Assist, Steal, Field_Goal_Percentage, Three_Point_Percentage
                      FROM Player_Statistics_Per_Game 
                      WHERE (Player LIKE '$player %' or Player LIKE '% $player' or Player = '$player') and Year = '$year'
                      ORDER BY Player, Age ASC;";
        $result = $connection->query($sqlquery);
        if($result -> num_rows > 0)
        {
          echo "$player's Basic Stats:</br>";
          echo '<table border = "1">';
          echo "<tr><th>Player<th>Position<th>Age<th>Year<th>Team<th>Point<th>Total_Rebound<th>Assist<th>
          Steal<th>FG%<th>3PT%</th></tr>";
          while($row = $result -> fetch_row())
          {
            echo "<tr>";
            for($i=0;$i<11;$i++)
            {
              echo "<td align='right'>$row[$i]</td>";
            }
            echo "</tr>";
          }
          $result -> free_result();
        }
      }
      else if($type == 'offensive')
      {
        $sqlquery = "SELECT Player, Position, Age, Year, Team, Point, Assist, Field_Goal_Percentage, Two_Point_Percentage,
                      Three_Point_Percentage, Free_Throw_Percentage FROM Player_Statistics_Per_Game 
                      WHERE (Player LIKE '$player %' or Player LIKE '% $player' or Player = '$player') and Year = '$year'
                      ORDER BY Player, Age ASC;";
        $result = $connection->query($sqlquery);
        if($result -> num_rows > 0)
        {
          echo "$player's Offensive Stats:</br>";
          echo '<table border = "1">';
          echo "<tr><th>Player<th>Position<th>Age<th>Year<th>Team<th>Point<th>Assist<th>FG%<th>
          2PT%<th>3PT%<th>FT%</th></tr>";
          while($row = $result -> fetch_row())
          {
            echo "<tr>";
            for($i=0;$i<11;$i++)
            {
              echo "<td align='right'>$row[$i]</td>";
            }
            echo "</tr>";
          }
          $result -> free_result();
        }
      }
      else if($type == 'defensive')
      {
        $sqlquery = "SELECT Player, Position, Age, Year, Team, Total_Rebound, Steal, Block FROM Player_Statistics_Per_Game 
                      WHERE (Player LIKE '$player %' or Player LIKE '% $player' or Player = '$player') and Year = '$year'
                      ORDER BY Player, Age ASC;";
        $result = $connection->query($sqlquery);
        if($result -> num_rows > 0)
        {
          echo "$player's Defensive Stats:</br>";
          echo '<table border = "1">';
          echo "<tr><th>Player<th>Position<th>Age<th>Year<th>Team<th>Rebound<th>Steal<th>Block</th></tr>";
          while($row = $result -> fetch_row())
          {
            echo "<tr>";
            for($i=0;$i<8;$i++)
            {
              echo "<td align='right'>$row[$i]</td>";
            }
            echo "</tr>";
          }
          $result -> free_result();
        }
      }
      else if($type == 'advanced')
      {
        $sqlquery = "SELECT * FROM Player_Statistics_Per_Game             
                      WHERE (Player LIKE '$player %' or Player LIKE '% $player' or Player = '$player') and Year = '$year'
                      ORDER BY Player, Age ASC;";
        $result = $connection -> query($sqlquery);
        if($result -> num_rows >= 0)
        {
          echo "$player's Advanced Stats:</br>";
          echo '<table border = "1">';
          echo "<tr><th>Player<th>Position<th>Age<th>Team<th>Game Played<th>Game Started<th>Average Time<th>FGM
          <th>FGA<th>FG%<th>3PTM<th>3PT<th>3PT<th>2PTM<th>2PTA<th>2PT%<th>EFG%<th>FTM<th>FTA<th>FT%<th>Offensive Rebound
          <th>Defensive Rebound<th>Turnove<th>Assist<th>Stea<th>Block<th>Turnover<th>Personal Foul<th>Point<th>year</tr>";
          while($row = $result -> fetch_row())
          {
            echo "<tr>";
            for($i=0;$i<30;$i++)
            {
              echo "<td align='right'>$row[$i]</td>";
            }
            echo "</tr>";
          }
          $result -> free_result();
        }
      }
    }
  }
  else if(($_POST['player']=='')&&$_POST['type']!='')   # 如果name为空，type非空
  {
    $team = $_POST['team'];
    $type = $_POST['type'];
    if($team != '') # 如果team非空
    {
      if($type == 'basic')
      {
        $sqlquery = "SELECT Player, Position, Age, Year, Team, Point, Total_Rebound, Assist, Steal, Field_Goal_Percentage, Three_Point_Percentage
                      FROM Player_Statistics_Per_Game WHERE Team = '$team' and Year = '$year'
                      ORDER BY Player, Age ASC;";
        $result = $connection->query($sqlquery);
        if($result -> num_rows > 0)
        {
          echo "$team's Players' Basic Stats:</br>";
          echo '<table border = "1">';
          echo "<tr><th>Player<th>Position<th>Age<th>Year<th>Team<th>Point<th>Total_Rebound<th>Assist<th>
          Steal<th>FG%<th>3PT%</th></tr>";
          while($row = $result -> fetch_row())
          {
            echo "<tr>";
            for($i=0;$i<11;$i++)
            {
              echo "<td align='right'>$row[$i]</td>";
            }
            echo "</tr>";
          }
          $result -> free_result();
        }
      }
      else if($type == 'offensive')
      {
        $sqlquery = "SELECT Player, Position, Age, Year, Team, Point, Assist, Field_Goal_Percentage, Two_Point_Percentage,
                      Three_Point_Percentage, Free_Throw_Percentage 
                      FROM Player_Statistics_Per_Game WHERE Team = '$team' and Year = '$year'
                      ORDER BY Player, Age ASC;";
        $result = $connection->query($sqlquery);
        if($result -> num_rows > 0)
        {
          echo "$team's Players' Offensive Stats:</br>";
          echo '<table border = "1">';
          echo "<tr><th>Player<th>Position<th>Age<th>Year<th>Team<th>Point<th>Assist<th>FG%<th>
          2PT%<th>3PT%<th>FT%</th></tr>";
          while($row = $result -> fetch_row())
          {
            echo "<tr>";
            for($i=0;$i<11;$i++)
            {
              echo "<td align='right'>$row[$i]</td>";
            }
            echo "</tr>";
          }
          $result -> free_result();
        }
      }
      else if($type == 'defensive')
      {
        $sqlquery = "SELECT Player, Position, Age, Year, Team, Total_Rebound, Steal, Block 
                      FROM Player_Statistics_Per_Game WHERE Team = '$team' and Year = '$year'
                      ORDER BY Player, Age ASC;";
        $result = $connection->query($sqlquery);
        if($result -> num_rows > 0)
        {
          echo "$team's Players' Defensive Stats:</br>";
          echo '<table border = "1">';
          echo "<tr><th>Player<th>Position<th>Age<th>Year<th>Team<th>Rebound<th>Steal<th>Block</th></tr>";
          while($row = $result -> fetch_row())
          {
            echo "<tr>";
            for($i=0;$i<8;$i++)
            {
              echo "<td align='right'>$row[$i]</td>";
            }
            echo "</tr>";
          }
          $result -> free_result();
        }
      }
      else if($type == 'advanced')
      {
        $sqlquery = "SELECT * FROM Player_Statistics_Per_Game WHERE Team = '$team' and Year = '$year'
                      ORDER BY Player, Age ASC;";
        $result = $connection -> query($sqlquery);
        if($result -> num_rows > 0)
        {
          echo "$team's Players' Advanced Stats:</br>";
          echo '<table border = "1">';
          echo "<tr><th>Player<th>Position<th>Age<th>Team<th>Game Played<th>Game Started<th>Average Time<th>FGM
          <th>FGA<th>FG%<th>3PTM<th>3PT<th>3PT<th>2PTM<th>2PTA<th>2PT%<th>EFG%<th>FTM<th>FTA<th>FT%<th>Offensive Rebound
          <th>Defensive Rebound<th>Turnove<th>Assist<th>Stea<th>Block<th>Turnover<th>Personal Foul<th>Point<th>year</tr>";
          while($row = $result -> fetch_row())
          {
            echo "<tr>";
            for($i=0;$i<30;$i++)
            {
              echo "<td align='right'>$row[$i]</td>";
            }
            echo "</tr>";
          }
          $result -> free_result();
        }
      }
    }
  }
}

if($_POST['player']!='' && $_POST['type']=='basic')
{
    #require_once('jpgraph/jpgraph.php');
	#require_once('jpgraph/jpgraph_line.php');
	$player = $_POST['player'];
    $sqlquery = "SELECT Player, Point, Assist, Steal, Total_Rebound as Rebound, Year
                          FROM Player_Statistics_Per_Game 
                          WHERE (Player LIKE '$player %' or Player LIKE '% $player' or Player = '$player')
                          ORDER BY Year ASC;";
    $result = $connection->query($sqlquery);
    if($result -> num_rows > 0)
    {
        $points = array();
		$assists = array();
		$steals = array();
		$rebounds = array();
		$years = array();
		while($row = $result -> fetch_assoc())
		{
			array_push($points, $row['Point']);
			array_push($assists, $row['Assist']);
			array_push($steals, $row['Steal']);
			array_push($rebounds, $row['Rebound']);
			array_push($years, $row['Year']);
			$player = $row['Player'];
		}
		$result -> free_result();
    }

	echo '<div id="section1">';
	GenGraph($points,$assists,$steals,$rebounds,$years,$player);
	echo '</div>';

	#header('content-type:image/jpg;');
	#$content=file_get_contents("./opt_jpg/{$player}.jpg");
	#echo $content;
	#echo '<img src="./opt_jpg/1.jpg" />';
}
$connection->close();
?>
</div>

<!-- <img src="./opt_jpg/1.jpg" /> -->

</body>
</html>





