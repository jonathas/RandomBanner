<?php
/**
 * Class RandomBanner
 * - Show random banners (Image or Flash)
 *
 * @author              Jonathas Rodrigues <jonathas@archlinux.us>
 * @copyright           2009, Jonathas Rodrigues
 * @version             1.5
 * @license             http://opensource.org/licenses/gpl-license.php GNU Public License
 */

class RandomBanner {

    private $content;

    private $links;

    private $height;

    private $width;

    private $banner;

    /*
     * This method adds a banner.
     * The associated values below, are the default ones for the parameters.
     * To add an image, $content and $link are necessary.
     * To add a Flash Banner, $content, $type and $pos are necessary, and
     * anything other than "img" must be associated to $type.
     * If you want the Flash Banner to be a sidebar banner, anything other than "top" must be associated to $pos.
     * The height and width for the top or sidebar Flash Banners can be changed below.
     * @access  public
     * @param   String $content
     * @param   String $link
     * @param   String $type
     * @param   String $pos
     * @return  void
    */
    public function setBanner($content,$link="nothing",$type="img",$pos="top") {
        
        $this->links[] = $link;
        $this->content[] = $content;

        if($type != "img") {

            if($pos == "top") {
                $this->height = "142";
                $this->width = "709";
            }
            else {
                $this->height = "371";
                $this->width = "117";
            }
        }
    }

    /*
     * This method randomizes the Banner
     * @access  private
     * @return  void
    */
    private function randomizeBanner() {
        $total = count($this->content);
        $total--;
        $this->banner = rand(0,$total);
    }

    /*
     * This method generates the banner's HTML.
     * It calls randomizeBanner(), finds out the file extension,
     * and if it is swf, it generates HTML to insert the Flash Banner.
     * If it is anything other than swf, it generates HTML to insert an image.
     * @access  private
     * @return  String
    */
    private function generateBanner() {

        $this->randomizeBanner();

        $ext = array_reverse(explode(".",$this->content[$this->banner]));

        if($ext[0] == "swf") {
            $result = "<object id=\"FlashID\" classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\" width=\"".$this->width."\" height=\"".$this->height."\">
                       <param name=\"movie\" value=\"".$this->content[$this->banner]."\" />
                       <param name=\"quality\" value=\"high\" />
                       <param name=\"wmode\" value=\"opaque\" />
                       <param name=\"swfversion\" value=\"9.0.45.0\" />
                       <!-- This param tag prompts users with Flash Player 6.0 r65 and higher to download the latest version of Flash Player. Delete it if you don’t want users to see the prompt. -->
                       <param name=\"expressinstall\" value=\"Scripts/expressInstall.swf\" />
                       <!-- Next object tag is for non-IE browsers. So hide it from IE using IECC. -->
                       <!--[if !IE]>-->
                       <object type=\"application/x-shockwave-flash\" data=\"".$this->content[$this->banner]."\" width=\"".$this->width."\" height=\"".$this->height."\">
                       <!--<![endif]-->
                       <param name=\"quality\" value=\"high\" />
                       <param name=\"wmode\" value=\"opaque\" />
                       <param name=\"swfversion\" value=\"9.0.45.0\" />
                       <param name=\"expressinstall\" value=\"Scripts/expressInstall.swf\" />
                       <!-- The browser displays the following alternative content for users with Flash Player 6.0 and older. -->
                       <div>
                       <h4>Content on this page requires a newer version of Adobe Flash Player.</h4>
                       <p><a href=\"http://www.adobe.com/go/getflashplayer\"><img src=\"http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif\" alt=\"Get Adobe Flash player\" width=\"112\" height=\"33\" /></a></p>
                       </div>
                       <!--[if !IE]>-->
                       </object>
                       <!--<![endif]-->
                       </object>
                       <script type=\"text/javascript\">
                       <!--
                       swfobject.registerObject(\"FlashID\");
                       //-->
                       </script>";

        }
        else {

            $result = "<a href=\"javascript:void(0);\" onclick=\"window.open('".$this->links[$this->banner]."');\">
                   <img class=\"banner\" src=\"".$this->content[$this->banner]."\" alt=\"Banner\" /></a>";

        }

        return $result;
    }

    /*
     * This method shows the random Banner.
     * @access  public
     * @return  void
    */
    public function showBanner() {
        echo $this->generateBanner();
    }

}

?>
