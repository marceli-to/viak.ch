<?php
namespace App\Http\Controllers\Api\Dashboard;
use App\Http\Controllers\Controller;
use App\Http\Resources\DataCollection;
use App\Models\TeamMember;
use App\Http\Requests\TeamMemberStoreRequest;
use Illuminate\Http\Request;

class TeamMemberController extends Controller
{
  
  /**
   * Get a list of TeamMembers
   * 
   * @return \Illuminate\Http\Response
   */
  public function get()
  {
    return new DataCollection(TeamMember::orderBy('order', 'ASC')->get());
  }

  /**
   * Get a single TeamMember
   * 
   * @param TeamMember $teamMember
   * @return \Illuminate\Http\Response
   */
  public function find(TeamMember $teamMember)
  {
    $teamMember = TeamMember::with('images')->find($teamMember->id);
    return response()->json($teamMember);
  }

  /**
   * Store a newly created TeamMember
   *
   * @param  \Illuminate\Http\TeamMemberStoreRequest $request
   * @return \Illuminate\Http\Response
   */
  public function store(TeamMemberStoreRequest $request)
  { 
    $teamMember = TeamMember::create(
      array_merge(
        $request->all(), 
        [
          'uuid' => \Str::uuid(), 
        ]
      )
    );

    return response()->json(['teamMemberId' => $teamMember->id]);
  }

  /**
   * Update a TeamMember for a given TeamMember
   *
   * @param TeamMember $teamMember
   * @param  \Illuminate\Http\TeamMemberStoreRequest $request
   * @return \Illuminate\Http\Response
   */
  public function update(TeamMember $teamMember, TeamMemberStoreRequest $request)
  {
    $teamMember = TeamMember::findOrFail($teamMember->id);
    $teamMember->update($request->all());
    return response()->json('successfully updated');
  }

  /**
   * Toggle the status a given TeamMember
   *
   * @param  TeamMember $teamMember
   * @return \Illuminate\Http\Response
   */
  public function toggle(TeamMember $teamMember)
  {
    $teamMember->publish = $teamMember->publish == 0 ? 1 : 0;
    $teamMember->save();
    return response()->json($teamMember->publish);
  }

  /**
   * Update the order the team members
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */

  public function order(Request $request)
  {
    $items = $request->get('items');
    foreach($items as $item)
    {
      $i = TeamMember::find($item['id']);
      $i->order = $item['order'];
      $i->save(); 
    }
    return response()->json('successfully updated');
  }

  /**
   * Remove a TeamMember
   *
   * @param  TeamMember $teamMember
   * @return \Illuminate\Http\Response
   */
  public function destroy(TeamMember $teamMember)
  {
    $teamMember->delete();
    return response()->json('successfully deleted');
  }
}
