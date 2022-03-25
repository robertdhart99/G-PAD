<?php
namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\ClassificationLevel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

/**
 * This controller handles all actions related to Classification Level Labels for
 * the Snipe-IT Asset Management application.
 *
 * @version    v1.0
 */
class ClassificationLevelController extends Controller
{
    /**
     * Show a list of all the Classification labels.
     *
     * @return \Illuminate\Contracts\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */

    public function index()
    {
        $data = ClassificationLevel::all();
        return view('classification_levels.view', ['data'=>$data]);
    }

    public function show($id)
    {
        $this->authorize('view', ClassificationLevel::class);
        if ($statuslabel = ClassificationLevel::find($id)) {
            return view('classificationlevel.view')->with('classificationlevel', $classificationlevel);
        }

        return redirect()->route('classificationlevels.index')->with('error', trans('admin/classificationlevels/message.does_not_exist'));
    }


    /**
     * classificationlevel create.
     *
     * @return \Illuminate\Contracts\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        // Show the page
        $this->authorize('create', ClassificationLevel::class);

        return view('classifications/edit')
            ->with('item', new ClassificationLevel)
            ->with('classification_types', Helper::classificationTypeList());
    }


    /**
     * ClassificationLevel create form processing.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(Request $request)
    {

        $this->authorize('create', ClassificationLevel::class);
        // create a new model instance
        $classificationLevel = new ClassificationLevel();

        if ($request->missing('classification_types')) {
            return redirect()->back()->withInput()->withErrors(['classification_types' => trans('validation.classification_type')]);
        }

        $classificationType = ClassificationLevel::getClassificationTypesForDB($request->input('classification_types'));

        // Save the Statuslabel data
        $classificationLevel->name              = $request->input('name');
        $classificationLevel->user_id           = Auth::id();
        $classificationLevel->levelOne        =  $classificationType['level One'];
        $classificationLevel->levelTwo           =  $classificationType['levelTwo'];
        $classificationLevel->levelThree         =  $classificationType['levelThree'];
        $classificationLevel->default_label     =  $request->input('default_label', 0);


        if ($classificationLevel->save()) {
            // Redirect to the new ClassificationLevel  page
            return redirect()->route('classificationlevels.index')->with('success', trans('admin/classificationlevels/message.create.success'));
        }
        return redirect()->back()->withInput()->withErrors($classificationLevel->getErrors());
    }

    /**
     * Classificationlevel update.
     *
     * @param  int $classificationId
     * @return \Illuminate\Contracts\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit($classificationId = null)
    {
        $this->authorize('update', ClassificationLevel::class);
        // Check if the ClassificationLevel exists
        if (is_null($item = ClassificationLevel::find($classificationId))) {
            // Redirect to the blogs management page
            return redirect()->route('classification.index')->with('error', trans('admin/classificationlevels/message.does_not_exist'));
        }

        $use_classification_type = $item->getClassificationType();

        $classification_types = array('' => trans('admin/hardware/form.select_classificationType')) + array('levelTwo' => trans('admin/hardware/general.levelTwo')) + array('levelThree' => trans('admin/hardware/general.levelThree')) + array('levelOne' => trans('admin/hardware/general.levelOne'));

        return view('classificationlevels/edit', compact('item', 'classification_types'))->with('use_classification_type', $use_classification_type);
    }


    /**
     * Classificationlevel update form processing page.
     *
     * @param  int $classificationId
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Request $request, $classificationId = null)
    {
        $this->authorize('update', ClassificationLevel::class);
        // Check if the ClassificationLevel exists
        if (is_null($classificationlevel = ClassificationLevel::find($classificationId))) {
            // Redirect to the blogs management page
            return redirect()->route('classificationlevels.index')->with('error', trans('admin/classificationlevels/message.does_not_exist'));
        }

        if (!$request->filled('classification_types')) {
            return redirect()->back()->withInput()->withErrors(['classification_types' => trans('validation.classification_type')]);
        }


        // Update the classificationlevel data
        $classificationtype                 = ClassificationLevel::getClassificationTypesForDB($request->input('classification_types'));
        $classificationlevel->name              = $request->input('name');
        $classificationlevel->levelOne          =  $statustype['levelOne'];
        $classificationlevel->levelTwo          =  $statustype['levelTwo'];
        $classificationlevel->levelThree          =  $statustype['levelThree'];
        $classificationlevel->default_label          =  $request->input('default_label', 0);


        // Was the asset created?
        if ($classificationlevel->save()) {
            // Redirect to the saved classificationlevel page
            return redirect()->route("classificationlevels.index")->with('success', trans('admin/classificationlevels/message.update.success'));
        }
        return redirect()->back()->withInput()->withErrors($classificationlevel->getErrors());
    }

    /**
     * Delete the given classificationlevel.
     *
     * @param  int $classificationId
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy($classificationId)
    {
        $this->authorize('delete', ClassificationLevel::class);
        // Check if the ClassificationLevel exists
        if (is_null($classificationlevel = ClassificationLevel::find($classificationId))) {
            return redirect()->route('classificationlevels.index')->with('error', trans('admin/classificationlevels/message.not_found'));
        }

        // Check that there are no assets associated
        if ($classificationlevel->assets()->count() == 0) {
            $classificationlevel->delete();
            return redirect()->route('classificationlevels.index')->with('success', trans('admin/classificationlevels/message.delete.success'));
        }

        return redirect()->route('classificationlevels.index')->with('error', trans('admin/classificationlevel/message.assoc_assets'));
    }

}
