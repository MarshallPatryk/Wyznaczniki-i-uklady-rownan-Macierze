<!doctype html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Układy równań - Macierze</title>
		<style>
		input.macierz{
			text-align:center;
			width: 40px;
			height: 50px;
		}
		input[type="submit"]{
			text-align:center;
			width: 80px;
			height: 30px;
		}
		#macierz{
			text-align:center;
			margin-top: 10px;
		}
		</style>
		<?php 
		require_once('bootstrap.php');
		?>
	</head>
	<body>
		<div id="macierz">
		<?php
		function Wymiar1($macierz){
			return $macierz[1][1];
		}
		
		function Wymiar2($macierz){
			return ($macierz[1][1]*$macierz[2][2])-($macierz[1][2]*$macierz[2][1]);
		}
		
		function Wymiar3($macierz){
			$x=$macierz[1][1]*$macierz[2][2]*$macierz[3][3] +
				$macierz[1][2]*$macierz[2][3]*$macierz[3][1] +
                $macierz[1][3]*$macierz[2][1]*$macierz[3][2] -
                $macierz[1][1]*$macierz[2][3]*$macierz[3][2] -
                $macierz[1][2]*$macierz[2][1]*$macierz[3][3] -
                $macierz[1][3]*$macierz[2][2]*$macierz[3][1];
			return $x;
		}
		
		//sprawdza po wierszach wymiar (zawsze kwadratowa macierz)
		function SprWymiar($macierz){
			$wymiar=1;
			while(isset($macierz[$wymiar][1])){
				$wymiar++;
			}
			return $wymiar-1; 
		}
		
		function WyswietlMacierz($macierz){
			$wymiar=SprWymiar($macierz);
			$wyswietl="";
			for($wiersz=1;$wiersz<=$wymiar;$wiersz++)
			{  
				$wyswietl = $wyswietl."<form style='margin-bottom: 0px;'>";
				for($kolumna=1;$kolumna<=$wymiar;$kolumna++)
				{
					$wyswietl = $wyswietl."<input class='macierz' type='number' value='".$macierz[$wiersz][$kolumna]."' width='5px' disabled>";
				}
				$wyswietl = $wyswietl."</form>";
			}
			return $wyswietl; 
		}
		
		//wykresla dana kolumne z macierzy
		function NowaMacierz($macierz, $kol){
			$macierzNowa[][]=array();
			$wymiar=SprWymiar($macierz);
			$wiersz2=1;
			for($wiersz=2;$wiersz<=$wymiar;$wiersz++)
			{  
				$dodaj=0;
				for($kolumna=1;$kolumna<=$wymiar-1;$kolumna++)
				{
					if($kol==$kolumna){
						$dodaj=1;
					}
					$macierzNowa[$wiersz2][$kolumna]= $macierz[$wiersz][$kolumna+$dodaj];	
					
				}
				$wiersz2++;
				}
			return $macierzNowa;
		}
		
		function NowaMacierzWstaw($macierz, $kol, $macierzB){
			$macierzNowa[][]=array();
			$wymiar=SprWymiar($macierz);
			$wierszB=0;
			for($wiersz=1;$wiersz<=$wymiar;$wiersz++)
			{  
				$dodaj=0;
				for($kolumna=1;$kolumna<=$wymiar;$kolumna++)
				{
					if($kol==$kolumna){
						$dodaj=1;
						$macierzNowa[$wiersz][$kolumna]= $macierzB[$wiersz][1];
					}else{
						$macierzNowa[$wiersz][$kolumna]= $macierz[$wiersz][$kolumna];	
					}
					
				}
			}
			return $macierzNowa;
		}
		
		function metodaLaplace($macierz)
			{
			$wyznacznik=0;
			$stopien=SprWymiar($macierz);
			if( $stopien > 3 ){
				for ($kolumna = 1; $kolumna <= $stopien; $kolumna++ )
				{
					$nowaMacierz= NowaMacierz($macierz, $kolumna);
					$wyznacznik = $wyznacznik + pow(-1,1+$kolumna) * $macierz[1][$kolumna] * metodaLaplace($nowaMacierz);				
				}
			}
			if($stopien==3){
				$wyznacznik = Wymiar3($macierz);
			}
			return $wyznacznik;
		}
	
		if(!isset($_POST['wymiar'])){
			//------------------------------------Podawanie wymiaru-----------------------------------------
		?>
			<form method="post">
				Podaj ilość równań/ilość niewiadomych:<br>
				<input type="number" id="macierze" name="wymiar" min="2" max="10" value="2"><br>
				<input type="submit" value="Zapisz"><br>
			</form> 
		<?php
		}else{
			if(!isset($_POST['1'])){
				//------------------------------------Wpisywanie wartości do macierzy----------------------
		?>
				<div class="alert alert-info">Wypełnij macierz</div>
				<form method="post">
				<div style="margin-right: 80px;">
				<?php
				for($i=1;$i<=$_POST['wymiar'];$i++){
					echo "<span style='margin-right:30px; margin-left: 10px;'><b>x</b><sub><i>".$i."</i></sub></span>";
				}
				
				echo "</div>";
				
				$wyniki=0;
				for($i=1;$i<=$_POST['wymiar']*$_POST['wymiar'];$i++){
					
					echo "<input class='macierz' type='number' value='0' name='".$i."' width='5px'>";
					if($i%$_POST['wymiar']==0){
						echo "<span style='margin-left: 20px; margin-right: 20px;'>=</span>";
						echo "<input class='macierz' type='number' value='0' name='wynik".++$wyniki."' width='5px'>";
						echo "</br>";
					}
				}
				?>
				<br>
				
				<input type="hidden" name="wymiar" value="<?php echo $_POST['wymiar'];?>">
				<input type="submit" value="Zapisz"><br>
				</form>
		<?php
			}else{
				//
				//sprawdzic ile ma wynikow
				//

				
				echo '<div class="alert alert-warning">'."Wymiar macierzy: ".$_POST["wymiar"]."x".$_POST["wymiar"]."</br>".'</div> </br>';
				$macierz[][]=array();
				
				$i=1;
				for($wiersz=1;$wiersz<=$_POST["wymiar"];$wiersz++)
				{  
					for($kolumna=1;$kolumna<=$_POST["wymiar"];$kolumna++)
					{
						$macierz[$wiersz][$kolumna]= $_POST[$i];
						$i++;
					}
				}
				for($wiersz=1;$wiersz<=$_POST["wymiar"];$wiersz++)
				{  
					$macierzB[$wiersz][1]= $_POST["wynik".$wiersz];
					
				}
				
				
				
				
				echo '<div class="alert alert-info">Macierz A</br>';
				//------------------------------------Wyświetlanie macierzy-----------------------------------------
				
				echo '<div style="margin-left: 20px;">';
				for($i=1;$i<=$_POST['wymiar'];$i++){
					echo "<span style='margin-right:30px; margin-left: 10px;'><b>x</b><sub><i>".$i."</i></sub></span>";
				}
				
				echo "</div>";
				echo WyswietlMacierz($macierz);
				
				if($_POST["wymiar"]==1){ //1 wymiarowa
					$wyznacznik=Wymiar1($macierz);
					echo '<div class="alert alert-success">'."Wyznacznik wynosi: ".$wyznacznik.'</div>';
				}else if($_POST["wymiar"]==2){ //2 wymiarowa
					$wyznacznik=Wymiar2($macierz);
					echo '<div class="alert alert-success">'."Wyznacznik wynosi: ".$wyznacznik.'</div>';
				}else if($_POST["wymiar"]==3){ //3 wymiarowa
					$wyznacznik=Wymiar3($macierz);
					echo '<div class="alert alert-success">'."Wyznacznik wynosi: ".$wyznacznik.'</div>';
				}else{ //4 wymiarowa i wiecej
					$wym1=SprWymiar($macierz);
					$wyznacznik=metodaLaplace($macierz, $wym1);
					echo '<div class="alert alert-success">'."Wyznacznik wynosi: ".$wyznacznik.'</div>';
				}	
				
				if($wyznacznik!=0){
					echo "Wyznacznik <b>różny</b> od 0 więc <b>rozwiązanie</b> jest tylko <b>jedno</b>.";
				}else{
					echo "<b>Nieskończenie wiele</b> lub <b>sprzeczny</b>.";
				}
				
				echo '</div>';
				
				echo '<div class="alert alert-warning">Macierz B</br>';
				//------------------------------------Wyświetlanie macierzy-----------------------------------------
				for($wiersz=1;$wiersz<=$_POST["wymiar"];$wiersz++){
				echo "<input class='macierz' type='number' value='".$macierzB[$wiersz][1]."' width='5px' disabled></br>";
				}
				echo '<div class="alert alert-success">A*X=B</br></div>';
				echo "</div></br>";
				
				
				//------------------------------------Liczenie wyznaczników-----------------------------------------
				if($wyznacznik!=0){
					for($wiersz=1;$wiersz<=$_POST["wymiar"];$wiersz++)
					{  
						$nowaMM=NowaMacierzWstaw($macierz, $wiersz, $macierzB);
						echo '<div class="alert alert-success"><b>x<sub>'.$wiersz.'</sub>'.WyswietlMacierz($nowaMM);
						
						if($_POST["wymiar"]==1){ //1 wymiarowa
							$wyznacznikX=Wymiar1($nowaMM);
						}else if($_POST["wymiar"]==2){ //2 wymiarowa
							$wyznacznikX=Wymiar2($nowaMM);
						}else if($_POST["wymiar"]==3){ //3 wymiarowa
							$wyznacznikX=Wymiar3($nowaMM);
						}else{ //4 wymiarowa i wiecej
							$wym1=SprWymiar($nowaMM);
							$wyznacznikX=metodaLaplace($nowaMM, $wym1);
						}
						
						echo "Wyznacznik tej macierzy:".$wyznacznikX."</br>";
						echo '<b>x<sub>'.$wiersz.'</sub> = '.$wyznacznikX.'/'.$wyznacznik.' = '.($wyznacznikX/$wyznacznik);
						
						echo '</div>';
						
					}
				}
			
		}
		}

		?>
		</div>
	</body>
</html>