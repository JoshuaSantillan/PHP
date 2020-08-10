<!DOCTYPE HTML>
<html>

	
	
	
			<form action="madlibs.php" method="post">
					<input type="text" placeholder="Adjective" name="Adjective"><br>
					<input type="text" placeholder="Another Adjective" name="Adjective2"><br>
					<input type="text" placeholder="Verb" name="Verb"><br>
					<input type="text" placeholder="Another Verb" name="Verb2"><br>
					<input type="text" placeholder="Past-Tense Verb" name="Past_Verb"><br>
					<input type="text" placeholder="Noun" name="Noun"><br>
					<input type="text" placeholder="Living Thing" name="Living_Thing"><br>
					<input type="text" placeholder="Girl's Name" name="Girl"><br><br>
					<button name="subject" type="submit" value="HTML">Generate</button>
				</form>
			
	
		
<?php			
			if(isset($_POST['Adjective']) && isset($_POST['Verb'])  && isset($_POST['Past_Verb']) && isset($_POST['Noun']) && isset($_POST['Girl']) && isset($_POST['Living_Thing']) && isset($_POST['Verb2']) && isset($_POST['Adjective2'])) {	
				
				function Assign_Variables() {
						$Adjective = $_POST['Adjective'];
						$Adjective2 = $_POST['Adjective2'];
						$Verb = $_POST['Verb'];
						$Verb2 = $_POST['Verb2'];
						$Past_Verb = $_POST['Past_Verb'];
						$Noun = $_POST['Noun'];
						$Girl = $_POST['Girl'];
						$Living_Thing = $_POST['Living_Thing'];
					
				Story($Adjective, $Adjective2, $Verb, $Verb2, $Past_Verb, $Noun, $Girl, $Living_Thing);
					
				}
				
				function Story($Adjective, $Adjective2, $Verb, $Verb2, $Past_Verb, $Noun, $Girl, $Living_Thing) {
						
						print 

							"<h2><b><font face='cursive';>THE FAIRLY TALE</b> </font><br> </h2>
							<p style='width: 45%;'>
							&nbsp;	&nbsp;	&nbsp;	&nbsp; Once upon a time there was a poor little girl named <u>$Girl</u> who lived in the forest with a(n) <u>$Adjective</u>
							<u>$Living_Thing</u>. She was forced to <u>$Verb</u> all day while the <u>$Living_Thing</u> sat around <u>$Verb2</u>. But 
							then one day the little girl found a magic <u>$Noun</u>. When <u>$Girl</u> picked up the <u>$Noun</u>, she found that anything she 		
							imagined came true. Soon, <u>$Girl</u> was making the <u>$Living_Thing</u> <u>$Verb</u> while she chose to sit around and	
							<u>$Verb2</u>. After a while, the girl realized this was not a very <u>$Adjective2</u> thing to do and released the 		
							<u>$Living_Thing</u> from her spell. They became best friends and <u>$Past_Verb</u> every day, living happily ever after.</p>";
					}
				Assign_Variables();
			
			}

		else {
			print"<br><b>Fill out the form for a story!</b>";
		}


?>
</html>
