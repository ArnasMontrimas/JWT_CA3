<?php

/**
 * 
 */
function setUserKeyAndType(String $api_key, String $membership, String $model, PDO $conn) {
    $_SESSION['api_key'] = $api_key;

    //Set message depending on which type of user it is
    if($membership == "premium") {
        $_SESSION['success'] = "Thank you for your purchase, subscription will be active for 30 days<br>Your subscription will be renewd automatically<br>To opt out change to free package";
    }
    elseif($membership == "free") {
        $_SESSION['success'] = "Your key is set you may use free service";
    }

    if($model::setUserApiKey($api_key, $conn, $_SESSION['user']['id'])) { 
        if($model::updateUserType($_SESSION['user']['id'], $membership, $conn)) {
            $_SESSION['user']['type'] = $membership;
            return true;
        }
        else {
            return false; 
        }
    } else return false;
}