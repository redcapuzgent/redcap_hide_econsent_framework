<?php
// Set the namespace defined in your config file

namespace uzgent\HideEconsentFramework;

// Declare your module class, which must extend AbstractExternalModule 
class HideEconsentFramework extends \ExternalModules\AbstractExternalModule
{

    function redcap_every_page_top($project_id)
    {
        $allowlist = $this->getSystemSetting('project-id');
        $allowed_projects = [];
        $allowed_projects = array_map('trim', $allowlist[0]);

        if (in_array($project_id, $allowed_projects, true)) {
            return;
        } else {
            if (str_contains(PAGE, 'online_designer')) {
                $urlScript = $this->getUrl('js/online_designer.js');
            } else if (str_contains(PAGE, 'PdfSnapshotController')) {
                $urlScript = $this->getUrl('js/pdf_snapshot_controller.js');
            }

            if ($urlScript != null) {
?>
                <script type="text/javascript" src="<?php echo $urlScript ?>"></script>
<?php
            }
        }
    }
}
