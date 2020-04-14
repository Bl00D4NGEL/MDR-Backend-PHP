<?php declare(strict_types=1);

namespace App\Controller;

use App\Domain\Division;
use App\Domain\Member\Positions\Commander;
use App\Domain\Member\Positions\Member;
use App\Domain\Member\Positions\TeamLeader;
use App\Domain\Member\Positions\Vice;
use App\Domain\Member\Positions\Warden;
use App\Domain\Member\Rank;
use App\Domain\ReportImporter;
use App\Domain\Roster;
use App\Domain\Team;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MemberController extends AbstractController
{
    /**
     * @Route("/test", name="testing")
     */
    public function testingCsv(ReportImporter $reportImporter): Response {
        $content = $reportImporter->import('report-2020.04.13.csv');
        return new Response(
            'Content:<br><pre>' . print_r($content, true) . '</pre>'
        );
    }

    /**
     * @Route("/member/{id}", name="member_info", requirements={"id"="^\d+$"})
     */
    public function showMemberInfoById(int $id): Response
    {
        $division = new Division('XXII');
        $dc = new Commander('Commander', 1, new Rank(Rank::COMMANDER));
        $vice = new Vice('Vice', 2, new Rank(Rank::MEMBER));
        $division->addCommander($dc);
        $division->addVice($vice);
        $division->addTeam($this->getTeamA());
        $division->addTeam($this->getTeamB());
        return $this->output($division);
    }

    private function output(Division $division): Response
    {
        $out = 'Division ' . $division->getName() . ' has ' . count($division->getMembers()) . ' members:<br>';
        foreach($division->getTeams() as $team) {
            $out .= "Team " . $team->getName() . " has " . count($team->getMembers()) . " members:<br>";
            /** @var Roster $roster */
            foreach ($team->getRosters() as $roster) {
                $out .= $roster->getFullyQualifiedRosterName() . " has " . count($roster->getMembers()) . " members.<br>";
            }   
        }
        return new Response($out);
    }

    private function getRosterA1(Member $member): Roster
    {
        $rosterLeader = new Warden('Roster Leader', 2, new Rank(Rank::WARDEN));
        $rosterA1 = new Roster('A', 1);
        $rosterA1->addMember($rosterLeader);
        $rosterA1->addMember($member);
        $rosterA1->addMember($member);
        $rosterA1->addMember($member);
        return $rosterA1;
    }

    private function getRosterA2(Member $member): Roster
    {
        $rosterA2 = new Roster('A', 2);
        $rosterA2->addMember($member);
        $rosterA2->addMember($member);
        $rosterA2->addMember($member);
        $rosterA2->addMember($member);
        $rosterA2->addMember($member);
        $rosterA2->addMember($member);
        return $rosterA2;
    }

    private function getTeamA(): Team
    {
        $member = new Member('Member', 123, new Rank(Rank::MEMBER));
        $team = new Team('A');
        $team->addRoster($this->getRosterA1($member));
        $team->addRoster($this->getRosterA2($member));
        $teamLeader = new TeamLeader('Team Leader', 3, new Rank(Rank::CAPTAIN));
        $team->addTeamLeader($teamLeader);
        return $team;
    }

    private function getTeamB(): Team {
        $member = new Member('Member #2', 234, new Rank(Rank::MEMBER));
        $team = new Team('B');
        $team->addRoster($this->getRosterB1($member));
        $teamLeader = new TeamLeader('Team Leader #2', 4, new Rank(Rank::CAPTAIN));
        $team->addTeamLeader($teamLeader);

        return $team;
    }

    private function getRosterB1(Member $member): Roster {
        $rosterLeader = new Warden('Roster Leader #2', 5, new Rank(Rank::WARDEN));
        $rosterB1 = new Roster('B', 1);
        $rosterB1->addMember($rosterLeader);
        $rosterB1->addMember($member);
        return $rosterB1;
    }
}
