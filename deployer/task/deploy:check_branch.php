<?php

namespace Deployer;

desc('Check current branch');
task('deploy:check_branch', function () {
    cd('{{deploy_path}}');
    $csv = run('tail -n 1 .dep/releases');
    if ($csv) {
        $metainfo = Csv::parse($csv)[0];
        if (isset($metainfo[2]) && isset($metainfo[3])) {
            $currentBranch = $metainfo[2];
            $userName = $metainfo[3];
            $branch = get('branch') ?: 'master';
            if ($currentBranch != $branch && input()->getParameterOption('--not-check-branch') === false) {
                throw new \RuntimeException(sprintf('Current branch (%s) deployed by "%s" is different than you try to deploy (%s). ',
                    $currentBranch, $userName, $branch));
            }
        }
    }
});
