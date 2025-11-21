<?php
// Set the namespace defined in your config file

namespace uzgent\HideEconsentFramework;

// Declare your module class, which must extend AbstractExternalModule 
class HideEconsentFramework extends \ExternalModules\AbstractExternalModule
{

    function redcap_every_page_top(int $project_id)
    {
        $allowlist = $this->getSubSettings('allowlist');
        $allowed_projects = [];

        foreach ($allowlist as $allowed) {
            $allowed_projects[] = intval($allowed['project-id']);
        }

        if (!in_array($project_id, $allowed_projects, true)) {
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
