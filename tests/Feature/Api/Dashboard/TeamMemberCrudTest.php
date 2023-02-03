<?php
use App\Models\User;
use App\Models\TeamMember;

test('admin can create, retrieve, update and destroy a team-member', function () {

  // Get admin user
  $user = User::admins()->first();
  expect($user)->toBeInstanceOf(User::class);

  // Login user
  Auth::login($user);

  // Create a new team-member
  $response = $this->post('/api/dashboard/team-member', [
    'firstname' => 'Hans',
    'name' => 'Muster'
  ]);
  $teamMemberId = $response->json('teamMemberId');
  expect($teamMemberId)->toBeInt();

  // Get a team-member from database
  $teamMember = TeamMember::first();
  expect($teamMember)->toBeInstanceOf(TeamMember::class);

  // Use that team-member to test the endpoint
  $response = $this->get('/api/dashboard/team-member/' . $teamMember->id);
  expect($response->status())->toBe(200);

  // Get all team-memberes via the endpoint
  $response = $this->get('/api/dashboard/team-members');
  expect($response->status())->toBe(200);

  // Update the newly created team-member
  $response = $this->put('/api/dashboard/team-member/' . $teamMemberId, [
    'title' => 'Lorem',
  ]);

  // Delete the newly created team-member
  $response = $this->delete('/api/dashboard/team-member/' . $teamMemberId);
  expect($response->status())->toBe(200);
});