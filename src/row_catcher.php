<?php
return [
    /*
     * ----------------------------------------------------------
     * the default minmum number of failures to start take action
     * ----------------------------------------------------------
     | Here we definig the minmum number of failures before fire egistered events
     | so may after catch five failures, fire event which will be responisible to
     | Push some helpfull info to admins about that
     */
    'min_critical_failures'  => 5,
];