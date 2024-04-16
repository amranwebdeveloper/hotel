<?php
namespace Modules\Hotel\Admin;

use Illuminate\Http\Request;
use Modules\AdminController;
use Modules\Hotel\Models\HotelInstitutional;
use Modules\Hotel\Models\HotelInstitutionalTranslation;

class InstitutionalController extends AdminController
{
    protected $hotelInstitutionalClass;
    public function __construct()
    {
        parent::__construct();
        $this->setActiveMenu(route('hotel.admin.index'));
        $this->hotelInstitutionalClass = HotelInstitutional::class;
    }

    public function index(Request $request)
    {
        $this->checkPermission('hotel_manage_others');
        $listInstitutional = $this->hotelInstitutionalClass::query();
        if (!empty($search = $request->query('s'))) {
            $listInstitutional->where('name', 'LIKE', '%' . $search . '%');
        }
        $listInstitutional->orderBy('created_at', 'desc');
        $data = [
            'rows'        => $listInstitutional->get()->toTree(),
            'row'         => new $this->hotelInstitutionalClass(),
            'translation'    => new HotelInstitutionalTranslation(),
            'breadcrumbs' => [
                [
                    'name' => __('Hotel'),
                    'url'  => route('hotel.admin.index')
                ],
                [
                    'name'  => __('Institutional'),
                    'class' => 'active'
                ],
            ]
        ];
        return view('Hotel::admin.institutional.index', $data);
    }

    public function edit(Request $request, $id)
    {
        $this->checkPermission('hotel_manage_others');
        $row = $this->hotelInstitutionalClass::find($id);
        if (empty($row)) {
            return redirect(route('hotel.admin.institutional.index'));
        }
        $translation = $row->translateOrOrigin($request->query('lang'));
        $data = [
            'translation'    => $translation,
            'enable_multi_lang'=>true,
            'row'         => $row,
            'parents'     => $this->hotelInstitutionalClass::get()->toTree(),
            'breadcrumbs' => [
                [
                    'name' => __('Hotel'),
                    'url'  => route('hotel.admin.index')
                ],
                [
                    'name'  => __('Institutional'),
                    'class' => 'active'
                ],
            ]
        ];
        return view('Hotel::admin.institutional.detail', $data);
    }

    public function store(Request $request , $id)
    {
        $this->checkPermission('hotel_manage_others');
        $this->validate($request, [
            'name' => 'required'
        ]);
        if($id>0){
            $row = $this->hotelInstitutionalClass::find($id);
            if (empty($row)) {
                return redirect(route('hotel.admin.institutional.index'));
            }
        }else{
            $row = new $this->hotelInstitutionalClass();
            $row->status = "publish";
        }

        $row->fill($request->input());
        $res = $row->saveOriginOrTranslation($request->input('lang'),true);

        if ($res) {
            return back()->with('success',  __('Institutional saved') );
        }
    }

    public function bulkEdit(Request $request)
    {
        $this->checkPermission('hotel_manage_others');
        $ids = $request->input('ids');
        $action = $request->input('action');
        if (empty($ids) or !is_array($ids)) {
            return redirect()->back()->with('error', __('Select at least 1 item!'));
        }
        if (empty($action)) {
            return redirect()->back()->with('error', __('Select an Action!'));
        }
        if ($action == "delete") {
            foreach ($ids as $id) {
                $query = $this->hotelInstitutionalClass::where("id", $id)->first();
                if(!empty($query)){
                    //Sync child institutional
                    $list_childs = $this->hotelInstitutionalClass::where("parent_id", $id)->get();
                    if(!empty($list_childs)){
                        foreach ($list_childs as $child){
                            $child->parent_id = null;
                            $child->save();
                        }
                    }
                    //Del parent institutional
                    $query->delete();
                }
            }
        } else {
            foreach ($ids as $id) {
                $query = $this->hotelInstitutionalClass::where("id", $id);
                $query->update(['status' => $action]);
            }
        }
        return redirect()->back()->with('success', __('Updated success!'));
    }

    public function getForSelect2(Request $request)
    {
        $pre_selected = $request->query('pre_selected');
        $selected = $request->query('selected');

        if($pre_selected && $selected){
            $item = $this->hotelInstitutionalClass::find($selected);
            if(empty($item)){
                return response()->json([
                    'text'=>''
                ]);
            }else{
                return response()->json([
                    'text'=>$item->name
                ]);
            }
        }
        $q = $request->query('q');
        $query = $this->hotelInstitutionalClass::select('id', 'name as text')->where("status","publish");
        if ($q) {
            $query->where('name', 'like', '%' . $q . '%');
        }
        $res = $query->orderBy('id', 'desc')->limit(20)->get();
        return response()->json([
            'results' => $res
        ]);
    }
}
