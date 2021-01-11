<?php
function delfile($file_path)
{
if(is_file($file_path)) { 
  if(unlink($file_path)) { 
    echo ""; 
  } 
  else { 
    echo ""; 
  } 
} 
else { 
  echo ""; 
} 
}


function GenGraph($points,$assists,$steals,$rebounds,$years,$player)
{
	require_once ('jpgraph/jpgraph.php');
	require_once ('jpgraph/jpgraph_line.php');
	// Setup the graph
	$graph = new Graph(550,300);
	$graph->SetScale("textlin");
	
	$theme_class=new UniversalTheme;
	
	$graph->SetTheme($theme_class);
	$graph->img->SetAntiAliasing(false);
	$graph->SetBox(false);
	
	$graph->SetMargin(40,20,36,63);
	
	$graph->img->SetAntiAliasing();
	
	$graph->yaxis->HideZeroLabel();
	$graph->yaxis->HideLine(false);
	$graph->yaxis->HideTicks(false,false);
	
	$graph->xgrid->Show();
	$graph->xgrid->SetLineStyle("solid");
	$graph->xaxis->SetTickLabels($years);
	$graph->xgrid->SetColor('#E3E3E3');
	
	$graph1= new Graph(550,300);
	$graph1->SetScale("textlin");
	
	$theme_class=new UniversalTheme;
	
	$graph1->SetTheme($theme_class);
	$graph1->img->SetAntiAliasing(false);
	$graph1->SetBox(false);
	
	$graph1->SetMargin(40,20,36,63);
	
	$graph1->img->SetAntiAliasing();
	
	$graph1->yaxis->HideZeroLabel();
	$graph1->yaxis->HideLine(false);
	$graph1->yaxis->HideTicks(false,false);
	
	$graph1->xgrid->Show();
	$graph1->xgrid->SetLineStyle("solid");
	$graph1->xaxis->SetTickLabels($years);
	$graph1->xgrid->SetColor('#E3E3E3');
	
	$graph->title->Set("Line Plot of {$player}'s basic data");
	$graph1->title->Set("Line Plot of {$player}'s points");
	
	# Create points_line
	$p1 = new LinePlot($points);
	$graph1->Add($p1);
	$p1->SetColor('#6495ED');
	$p1->SetLegend('Point');
	
	# Create Assist_line
	$p2 = new LinePlot($assists);
	$graph->Add($p2);
	$p2->SetColor('#B22222');
	$p2->SetLegend('Assist');
	
	# Create Steal_line
	$p3 = new LinePlot($steals);
	$graph->Add($p3);
	$p3->SetColor('#FF1493');
	$p3->SetLegend('Steal');
	
	# Create Rebound_line
	$p4 = new LinePlot($rebounds);
	$graph->Add($p4);
	$p4->SetColor('#006666');
	$p4->SetLegend('Rebound');
	
	$graph->legend->SetFrameWeight(1);
	$graph1->legend->SetFrameWeight(1);
	
	#$graph->Stroke("./opt_jpg/{$player}.jpg");
	#showImg("./opt_jpg/{$player}.jpg");
	$graph1->Stroke("./opt_jpg/1.jpg");
	$graph->Stroke("./opt_jpg/2.jpg");
	echo '<img src="./opt_jpg/1.jpg" /></br></br></br>';
	echo '<img src="./opt_jpg/2.jpg" />';
	
}

?>