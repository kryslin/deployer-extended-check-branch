<?php

namespace Deployer;

use Deployer\Type\Csv;

desc('Add custom information to the release log file');
task('deploy:extend_log', function () {
    cd('{{deploy_path}}');
    $csv = run('tail -n 1 .dep/releases');
    $metainfo = Csv::parse($csv)[0];
    $metainfo[2] = get('branch') ?: 'master';
    $metainfo[3] = runLocally('git config user.name')->toString();
    run("echo '".implode(',', $metainfo)."' >> .dep/branch");
});
