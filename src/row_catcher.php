<?php
return [
    /*
     * ----------------------------------------------------------------------------
     * the default minimum number of failures to start take action
     * ----------------------------------------------------------------------------
     | Here we defining the minimum number of failures before fire registered events
     | so may after catch five failures, fire event which will be responsible to
     | Push some helpfully info to admins about that
     */
    'min_critical_failures'  => 5,
];