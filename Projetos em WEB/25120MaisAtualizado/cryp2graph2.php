<?php
function CriaAlgo($tamanho) {
		  //                   1         2         3
		  if ($tamanho==0) { $tamanho=8; }
		  //INDICE   0123456789012345678901234567890
		  $sLetras ='ABCDEFGHJKLMNPQRSTUVXYWZ';
		  $sNumeros='0123456789';
		  $lnt=$tamanho;
		  $novaSenha='';
		  for( $lni=0; $lni<$lnt; $lni++) {
		    if (($lni % 2)==0) {
		    	$sorte=intval(rand(0,23));
		    	$novaSenha.=substr($sLetras,$sorte,1);
		    } else {
		    	$sorte=intval(rand(0,9));
		    	$novaSenha.=substr($sNumeros,$sorte,1);
		    }
		  }
		  return $novaSenha;
}

function FazSenha($username,$password) {
		// Create a 256 bit (64 characters) long random salt
		// Let's add 'something random' and the username
		// to the salt as well for added security
		$salt = hash('sha256', uniqid(mt_rand(), true) . CriaAlgo(18) . strtolower($username));
		// Prefix the password with the salt
		$hash = $salt . $password;
		$loops=10; // 80 - 300
		// Hash the salted password a bunch of times
		for ( $i = 0; $i < $loops; $i ++ ) {
		  $hash = hash('sha256', $hash);
		}
		// Prefix the hash with the salt so we can find it back later
		$hash = $salt . $hash;
		return $hash;
}

function ChecaSenha($password,$dbpassword) {
		// The first 64 characters of the hash is the salt
		$salt = substr($dbpassword, 0, 64);
		$hash = $salt . $password;
		// Hash the password as we did before
		$loops=10;
		for ( $i = 0; $i < $loops; $i ++ ) {
		  $hash = hash('sha256', $hash);
		}
		$hash = $salt . $hash;
		if ( $hash == $dbpassword ) {
			return true;
		} else {
			return false;
		}
}
?>