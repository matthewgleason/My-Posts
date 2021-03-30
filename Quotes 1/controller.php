<?php
// This file contains a bridge between the view and the model and redirects back to the proper page
// with after processing whatever form this code absorbs. This is the C in MVC, the Controller.
//
// Authors: Rick Mercer and Matthew Gleason
//  
session_start (); // Not needed in Quotes1

require_once './DatabaseAdaptor.php';

$theDBA = new DatabaseAdaptor();

if (isset ( $_GET ['command'] ) && $_GET ['command'] === 'getQuotes') {
    $arr = $theDBA->getAllQuotations();
    unset($_GET ['command']);
    echo getQuotesAsHTML ( $arr );
    
} else if (isset ($_POST['author']) && isset($_POST['quote'])) {
    $theDBA->addQuote(htmlspecialchars($_POST['quote']), htmlspecialchars($_POST['author']));
    unset($_POST ['quote']);
    unset($_POST ['author']);
    header("Location: view.php");
} else if (isset ($_POST['increase'])) {
        $theDBA->incRating($_POST['increase']);
        unset($_POST ['increase']);
        header("Location: view.php");
} else if (isset ($_POST['decrease'])) {
        $theDBA->decRating($_POST['decrease']);
        unset($_POST ['decrease']);
        header("Location: view.php");
} else if (isset ($_POST['delete'])){
        $theDBA->deleteQuote($_POST['delete']);
        unset($_POST ['delete']);
        header("Location: view.php");
} else if (isset($_POST['registerUsername']) && isset($_POST['registerPassword'])) {
    if (!($theDBA->verifyCredentials(htmlspecialchars($_POST['registerUsername']), htmlspecialchars($_POST['registerPassword'])))) {
        
        $specPas = htmlspecialchars($_POST['registerPassword']);
        $specUs = htmlspecialchars($_POST['registerUsername']);
        
        $hashed_password = password_hash($specPas, PASSWORD_DEFAULT);
        
        $theDBA->addUser($specUs, $hashed_password);
        unset($_POST ['registerUsername']);
        unset($_POST ['registerPassword']);
    
        header("Location: view.php");
    } else {
        $_SESSION['registrationError'] =  'Account name taken';
        unset($_POST ['registerUsername']);
        unset($_POST ['registerPassword']);
        header("Location: register.php");
    }
} else if (isset($_POST['loginUsername']) && isset($_POST['loginPassword'])) {
    if ($theDBA->verifyCredentials(htmlspecialchars($_POST['loginUsername']), htmlspecialchars($_POST['loginPassword']))) {
        
        
        $_SESSION['user'] = htmlspecialchars($_POST ['loginUsername']);
        unset($_POST ['loginUsername']);
        unset($_POST ['loginPassword']);
        header("Location: view.php");
    } else {
        $_SESSION['registrationError'] = 'Login credentials not valid'; 
        unset($_POST ['loginUsername']);
        unset($_POST ['loginPassword']);
        header("Location: login.php");
    }
}
    

function getQuotesAsHTML($arr) {
    // TODO 6: Many things. You should have at least two quotes in 
    // table quotes. layout each quote using a combo of PHP and HTML 
    // strings that includes HTML for buttons along with the actual 
    // quote and the author, ~15 PHP statements. This function will 
    // be the most time consuming in Quotes 1. You will
    // need to add css rules to styles.css.  
    
    if (isset($_SESSION['user'])) {
        $result = "<button class='buttonLayout' onClick=\"document.location.href='logout.php'\">Logout</button><br><button class='buttonLayout' onClick=\"document.location.href='addQuote.php'\">Add Quote</button>";
        $result .= '<i>Hello ' . $_SESSION['user'] . '</i>';
        
    } else {
        $result = "<button class='buttonLayout' onClick=\"document.location.href='register.php'\">Register</button><br><button class='buttonLayout' onClick=\"document.location.href='login.php'\">Login</button>";
    }
    
    usort($arr, function($a, $b) {
        return $b['rating'] - $a['rating'];
    });
    
    foreach ( $arr as $quote ) {
        $result .= '<div class="container">';
        $result .= '"' . $quote ['quote'] . '"';
        // Add more below
        $result .= ' <p class="author">&nbsp;&nbsp;--' . $quote['author'] . '<br></p>';
        $result .= '<form action="controller.php" method="post">' . 
        '<input type="hidden" name="ID" value="7">&nbsp;&nbsp;&nbsp;' . 
        '<button name="increase" value="' . $quote['id'] . '">+</button>' . 
        '&nbsp;<span id="rating">' . $quote['rating'] . '</span>&nbsp;&nbsp;' .
        '<button name="decrease" value="' . $quote['id'] . '">-</button>&nbsp;&nbsp;';
        if (isset($_SESSION['user'])) {
            $result .= '<button name="delete" value="' . $quote['id'] . '">Delete</button>';
        }

        $result .= '</form></div>';
        
    }
    
    return $result;
}
?>