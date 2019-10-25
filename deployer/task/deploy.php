<?php

namespace Deployer;

before('deploy:check_lock','deploy:check_branch');
after('deploy:release','deploy:extend_log');

