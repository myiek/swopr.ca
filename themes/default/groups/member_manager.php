<?php
/***********************************************
* This file is part of PeoplePods
* (c) xoxco, inc  
* http://peoplepods.net http://xoxco.com
*
* theme/groups/member_manager.php
* Defines the group member manager page
*
*
* Documentation for this pod can be found here:
* http://peoplepods.net/readme/group-object
/**********************************************/
?>

<?
	$membership = $group->isMember($group->POD->currentUser());
?>
		<div class="column_padding">
			<h1><? $group->permalink(); ?> &#187; Members</h1>

			<? echo $group->members()->totalCount(); ?> members | <a href="<? $group->POD->siteRoot(); ?>/invite?group=<? $group->write('id'); ?>">Invite Someone</a>
		</div>


			<div class="column_6">
				<div class="column_padding">
					<B>Member</B>
				</div>
			</div>
			<div class="column_2">
				<div class="column_padding">
					<b>Type</b>
				</div>
			</div>
			<div class="clearer"></div>



			<? 
			$group->members()->sortBy('type');
			while ($person = $group->members()->getNext()) { ?>
			
				<div id="member_<? $person->write('id'); ?>" class="group_list_member">
					<? $person->output('avatar'); ?>
					<div class="column_5">
						<div class="column_padding">
							<? $person->permalink(); ?>
							<? if ($person->get('tagline')) { ?><Br />
							<span class="tagline"><? $person->write('tagline');  }?></span>
						</div>
					</div>
					<div class="column_2">
						<div class="column_padding" id="member_type_<? $person->write('id'); ?>">
							<? $member_type = $group->isMember($person); 
								echo $member_type; ?>
						</div>
					</div>
					<div class="column_4 last right_align">
						<? if ($membership == "owner" || $membership == "manager") { ?>						
							<div class="column_padding" id="member_invitee_<? $person->write('id'); ?>" <? if ($member_type != "invitee") { ?>style="display: none;"<? } ?>>
								<a href="#" onclick="return removeMember(<? $group->write('id'); ?>,<? $person->write('id'); ?>);">Cancel Invitation</a>
							</div>
							<div class="column_padding" id="member_member_<? $person->write('id'); ?>" <? if ($member_type != "member") { ?>style="display: none;"<? } ?>>
								<a href="#" onclick="return changeMemberType(<? $group->write('id'); ?>,<? $person->write('id'); ?>,'manager');">Promote</a> &middot;
								<a href="#" onclick="return removeMember(<? $group->write('id'); ?>,<? $person->write('id'); ?>);">Remove</a>
							</div>
							<div class="column_padding" id="member_manager_<? $person->write('id'); ?>" <? if ($member_type != "manager" && $member_type != 'owner') { ?>style="display: none;"<? } ?>>
								<a href="#" onclick="return changeMemberType(<? $group->write('id'); ?>,<? $person->write('id'); ?>,'member');">Demote</a> &middot;
								<a href="#" onclick="return removeMember(<? $group->write('id'); ?>,<? $person->write('id'); ?>);">Remove</a>
							</div>	
						<? } ?>
					</div>
					<div class="clearer"></div>
				</div>
			<? } ?>

			<br />
