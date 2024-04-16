<?php
	namespace Modules\Core\Walkers;
    use Illuminate\Support\Facades\DB;

	class MenuWalker
	{
		protected static $currentMenuItem;
		protected        $menu;
		protected $activeItems = [];

		public function __construct($menu)
		{
			$this->menu = $menu;
		}

		public function generate()
		{
			$items = json_decode($this->menu->items, true);
			if (!empty($items)) {
				echo '<ul class="main-menu menu-generated">';
				$this->generateTree($items);
				echo '</ul>';
			}
		}

		public function generateTree($items = [],$depth = 0,$parentKey = '')
		{

			foreach ($items as $k=>$item) {
				$class = e($item['class'] ?? '');
				$url = $item['url'] ?? '';
				$megamenu = $item['mega_menu'] ?? '';
				$image1 = $item['mega_menu_image_1'] ?? '';
				$image2 = $item['mega_menu_image_2'] ?? '';
				$item['target'] = $item['target'] ?? '';
				if (!isset($item['item_model']))
					continue;
				if (class_exists($item['item_model'])) {
					$itemClass = $item['item_model'];

					$itemObj = $itemClass::find($item['id']);
                    $hotels =  DB::table('bravo_hotel_category_relationships')->where('category_id',$itemObj->id)->get();
                    $counthotels= (count($hotels)>1) ? '<span class="hotel-count">'.count($hotels).' Hotels </span>' : '<span class="hotel-count">0 Hotel</span>';

					if (empty($itemObj)) {
						continue;
					}
					$url = $itemObj->getDetailUrl();
				}
				if ($this->checkCurrentMenu($item, $url))
				{
					$class .= ' active';
					$this->activeItems[] = $parentKey;
				}

				if (!empty($item['children'])) {
					ob_start();
					$this->generateTree($item['children'],$depth + 1,$parentKey.'_'.$k);
					$html = ob_get_clean();
					if(in_array($parentKey.'_'.$k,$this->activeItems)){
						$class.=' active ';
					}
				}
				$class.=' depth-'.($depth);
				printf('<li class="%s">', $class);
                if (!empty($item['children'])) {
					$item['name'] .= ' <i class="caret fa fa-angle-down"></i>';
				}
                if($class==' depth-2'){
                    printf('<a  target="%s" href="%s" >%s - %s</a>', e($item['target']), e($url), clean($item['name']),$counthotels);
                } else {
                    printf('<a  target="%s" href="%s" >%s</a>', e($item['target']), e($url), clean($item['name']));
                }
                // <span class="hotel-count">@if(count($hotels)>1) {{count($hotels)}} Hotels @elseif(count($hotels)==1) 1 Hotel @else 0 Hotel @endif  </span>

				if($class=='mega-menu depth-0'){
                    if (!empty($item['children'])) {
                        echo '<div class="mega-menu-all">';
                            echo '<div class="mega-menu-left">';
                                echo '<ul class="children-menu menu-dropdown">';
                                echo $html;
                                echo "</ul>";
                            echo "</div>";
                            echo '<div class="mega-menu-right">';
                                echo '<img src="http://localhost:8080/tatilbenim.com/public/uploads/demo/space/space-1.jpg">';
                            echo "</div>";
                        echo "</div>";
                    }
                } else {
                    if (!empty($item['children'])) {
                        echo '<ul class="children-menu menu-dropdown">';
                        echo $html;
                        echo "</ul>";
                    }

                }
				echo '</li>';
			}
		}

		protected function checkCurrentMenu($item, $url = '')
		{

			if(trim($url,'/') == request()->path()){
				return true;
			}
			if (!static::$currentMenuItem)
				return false;
			if (empty($item['item_model']))
				return false;
			if (is_string(static::$currentMenuItem) and ($url == static::$currentMenuItem or $url == url(static::$currentMenuItem))) {
				return true;
			}
			if (is_object(static::$currentMenuItem) and get_class(static::$currentMenuItem) == $item['item_model'] && static::$currentMenuItem->id == $item['id']) {
				return true;
			}
			return false;
		}

		public static function setCurrentMenuItem($item)
		{
			static::$currentMenuItem = $item;
		}

		public static function getActiveMenu()
		{
			return static::$currentMenuItem;
		}
	}
