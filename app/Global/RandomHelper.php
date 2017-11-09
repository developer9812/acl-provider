<?php

function unique_user_id()
{
  return "w".uniqid().bin2hex(random_bytes(5));
}

?>
