<h1>choix quiz</h1>

<?php  
$allQuiz = $user->getQuestionnaire($user->getId()); 

$max = sizeof($allQuiz);
for($i = 0; $i < $max;$i++){
	echo $allQuiz[$i]['titre'];
	echo "<br>" ;
}


?>