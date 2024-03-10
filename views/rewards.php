<!DOCTYPE html>
<html lang="en">
<head>
    <include href="views/header.html"/>
    <title>Rewards</title>
    <include href="views/NavBar.html"/>
</head>
<body id="rewardsBody">

<?php

?>
<repeat group = "{{ @orders }}" value = "{{ @row }}">
    <p>{{ @SESSION.userOrders }}, {{ @order.food }}, {{ @order.meal }},
        {{ @order.condiments }}, {{ @order.date_time }},</p>
</repeat>
</body>
</html>