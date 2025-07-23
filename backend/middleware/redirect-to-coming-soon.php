<?php

// 1. Define the path to the Coming Soon page
$comingSoonPath = $paths['static']['coming_soon'];

// 2. Redirect the user
header("Location: $comingSoonPath");
exit;
