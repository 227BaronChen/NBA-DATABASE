SET GLOBAL local_infile = 1;
CREATE DATABASE Team_Project;
USE Team_Project;

create table Player_Statistics_Per_Game(
    Player varchar(50) NOT NULL,
    Position varchar(5),
    Age int,
    Team varchar(3),

    Game_Played  int,
    Game_Started int,
    Minutes_Played float(6,1),

    FGM float(6,1),
    FGA float(6,1),
    Field_Goal_Percentage float(6,3),

    Three_Point_Made float(6,1),
    Three_Point_Attempt float(6,1),
    Three_Point_Percentage float(6,3),

    Two_Point_Made float(6,1),
    Two_Point_Attempt float(6,1),
    Two_Point_Percentage float(6,3),

    Effective_Field_Goal_Percentage float(6,3),

    Free_Throw_Made float(6,1),
    Free_Throw_Attempt float(6,1),
    Free_Throw_Percentage float(6,3),

    Offensive_Rebound float(6,1),
    Defensive_Rebound float(6,1),
    Total_Rebound float(6,1),

    Assist float(6,1),
    Steal float(6,1),
    Block float(6,1),
    Turnover float(6,1),
    Personal_Foul float(6,1),
    Point float(6,1),
    Year int
	CONSTRAINT pk_player_year PRIMARY KEY (Player, Year),
	CONSTRAINT year_range CHECK (Year >= 1950 and Year <= 2020),
);

load data local infile './PlayerStatisticsPerGame.csv'
into table Player_Statistics_Per_Game
fields terminated by ','
enclosed by '"'
lines terminated by '\n'
ignore 1 lines;