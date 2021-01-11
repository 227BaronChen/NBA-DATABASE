# 示例：
# ATL <- Get_Schedule("ATL", 2018)

# 输入想要爬取的球队赛程的队名：
team_list <- c("HOU", "SAS", "DAL", "MEM", "NOP",
               "GSW", "LAC", "SAC", "PHO", "LAL",
               "OKC", "POR", "UTA", "DEN", "MIN",
               "TOR", "BOS", "NYK", "BRK", "PHI",
               "MIA", "ATL", "CHO", "WAS", "ORL",
               "CLE", "IND", "DET", "CHI", "MIL"
               )
# team_list <- c("HOU", "SAS")
year_list <- c(2016:2020)
# year_list <- c(2020)


# 爬取数据：
Get_Schedule <- function(team, season) 
{
  # 读取.html，此处是相应球队赛程安排的URL
  url <- paste(getOption("NBA_api_base"), "/teams/", team, "/", season, "_games.html", sep = "")
  pg <- xml2::read_html(url)
  
  nba_stats <- rvest::html_table(pg, fill = T)[[1]]
  if (utils::packageVersion("janitor") > "0.3.1") {
    nba_stats <- nba_stats %>% janitor::clean_names(case = "old_janitor")
  }
  else {
    nba_stats <- nba_stats %>% janitor::clean_names() %>% 
      janitor::remove_empty_cols()
  }
  nba_stats <- nba_stats[-c(21, 42, 63, 84), ] %>% dplyr::mutate(g = as.numeric(.data$g), 
                                                                 tm = as.numeric(.data$tm), opp = as.numeric(.data$opp), 
                                                                 w = as.numeric(.data$w), l = as.numeric(.data$l))
  colnames(nba_stats)[6] <- "away_indicator"
  nba_stats <- dplyr::tbl_df(nba_stats) %>% dplyr::mutate(diff = .data$tm - .data$opp, 
                                                          avg_diff = cumsum(.data$diff)/.data$g, 
                                                          away = cumsum(.data$away_indicator == "@"), 
                                                          daysbetweengames = c(NA, as.vector(diff(lubridate::mdy(.data$date)))))
  
  return(nba_stats)
}

i = 1
j = 1
NBASchedule = NULL

while(!is.na(team_list[i])){
  info_total = NULL
  team <- team_list[i]
  while(!is.na(year_list[j])){
    year <- year_list[j]
    # info
    info <- Get_Schedule(team, year)
    info_total <- rbind(info_total, info)
    j <- j + 1
  }
  # name
  name <- data.frame(nm=rep(team, nrow(info_total)))
  # name_info
  name_info <- cbind(name, info_total)
  # gather
  NBASchedule <- rbind(NBASchedule, name_info)
  i <- i + 1; j <- 1
}

# 生成.csv文件：
write.csv(NBASchedule, file = "NBASeasonTeamByYear_Gather.csv")
