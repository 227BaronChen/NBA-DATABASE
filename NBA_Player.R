# ʾ����
# James <- Get_Player("/players/j/jamesle01.html")
# head(James)
# write.csv(James, file = "James.csv")
library(stringr)

# ������Ҫ��ȡ����Ա��������
player_name <- read.csv("Player_name.csv")[,2]
player_name_ <- tolower(str_split_fixed(player_name, " ", n=2)) # �ָ��ַ������Ҷ�ת��Сд

# ��ȡ����
Get_Player <- function(player_link) 
{
  # ��ȡ.html���˴�����Ӧ��Ա���ݵ�URL
  player_url <- paste(getOption("NBA_api_base"), player_link, sep = "")
  pg <- xml2::read_html(player_url)
  # ������ҳ���ݱ������ݵ�R�����ݿ���
  tmp <- rvest::html_table(pg, fill = T)
  ifelse(ncol(tmp[[1]]) == 21, player_stats <- tmp[[2]], player_stats <- tmp[[1]])
  if (utils::packageVersion("janitor") > "0.3.1") {
    player_stats <- player_stats %>% janitor::clean_names(case = "old_janitor")
  }
  else {
    player_stats <- player_stats %>% janitor::clean_names() %>% janitor::remove_empty_cols()
  }
  player_stats <- player_stats[!grepl("Did Not Play", player_stats$g), ]
  
  return(player_stats)
}

i = 1
NBAPlayer <- NULL
while(!is.na(player_name[i])){
# while(i < 100){
  # info
  pn = player_name_[i,]
  h0 <- substr(pn[2], 1, 1) # �յ�����ĸ
  h1 <- substr(pn[1], 1, 2) # ����ǰ������ĸ
  h2 <- substr(pn[2], 1, 5) # �յ�ǰ�����ĸ
  h12 <- str_c(h2, h1)
  h12 <- gsub("[.'* ]","", h12)
  if(nchar(h12) != 7) {i <- i + 1; next;}
  ph <- str_c("/players/", h0, "/", h2, h1, "01.html")
  info <- Get_Player(ph)
  # name
  name <- data.frame(nm=rep(player_name[i], nrow(info)))
  # name_info
  name_info <- cbind(name, info)
  # gather
  NBAPlayer <- rbind(NBAPlayer, name_info)
  i <- i + 1
}
NBAPlayer <- subset(NBAPlayer, NBAPlayer$age!="NA")

# NBAPlayerPerGameStats_Gather <- function(){
#   # while(!is.na(player_name[i])){
#   while(i < 5){
#     # info
#     pn = player_name_[i,]
#     h0 <- substr(pn[2], 1, 1) # �յ�����ĸ
#     h1 <- substr(pn[1], 1, 2) # ����ǰ������ĸ
#     h2 <- substr(pn[2], 1, 5) # �յ�ǰ�����ĸ
#     ph <- str_c("/players/", h0, "/", h2, h1, "01.html")
#     info <- NBAPlayerPerGameStats(ph)
#     # name
#     name <- data.frame(rep(player_name[i], nrow(info)))
#     # name_info
#     name_info <- cbind(name, info)
#     # gather
#     NBAPlayer <- rbind(NBAPlayer, name_info)
#     i <- i + 1
#   }
# }
# NBAPlayerPerGameStats_Gather()

# ����.csv�ļ���
write.csv(NBAPlayer, file = "NBAPlayerPerGameStats_Gather.csv")