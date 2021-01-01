<?php

namespace Dspurl\DsshopInstaller\Controllers;

use Illuminate\Routing\Controller;
use Dspurl\DsshopInstaller\Events\DsshopInstallerFinished;
use Dspurl\DsshopInstaller\Helpers\EnvironmentManager;
use Dspurl\DsshopInstaller\Helpers\FinalInstallManager;
use Dspurl\DsshopInstaller\Helpers\InstalledFileManager;

class FinalController extends Controller
{
    /**
     * Update installed file and display finished view.
     *
     * @param InstalledFileManager $fileManager
     * @param FinalInstallManager $finalInstall
     * @param EnvironmentManager $environment
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function finish(InstalledFileManager $fileManager, FinalInstallManager $finalInstall, EnvironmentManager $environment)
    {
        $finalMessages = $finalInstall->runFinal();
        $finalStatusMessage = $fileManager->update();
        $finalEnvFile = $environment->getEnvContent();

        event(new DsshopInstallerFinished);

        return view('vendor.installer.finished', compact('finalMessages', 'finalStatusMessage', 'finalEnvFile'));
    }
}
