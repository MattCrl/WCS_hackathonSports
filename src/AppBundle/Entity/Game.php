<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Game
 *
 * @ORM\Table(name="game")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\GameRepository")
 */
class Game
{

    /**
     * @ORM\ManyToOne(targetEntity="Team")
     */
    private $team1;

    /**
     * @ORM\ManyToOne(targetEntity="Team")
     */
    private $team2;


    /**
     * @ORM\ManyToOne(targetEntity="Game", cascade={"persist"})
     */
    private $prevGame1;

    /**
     * @ORM\ManyToOne(targetEntity="Game", cascade={"persist"})
     */
    private $prevGame2;

    /**
     * @ORM\ManyToOne(targetEntity="Tournament", inversedBy="games")
     */
    private $tournament;

    /**
     * @var integer
     *
     * @ORM\Column(name="level", type="integer")
     *
     */
    private $level;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="start_at", type="datetime", nullable=true)
     */
    private $startAt;

    /**
     * @var string
     *
     * @ORM\Column(name="place", type="string", length=255, nullable=true)
     */
    private $place;

    /**
     * @var integer
     *
     * @ORM\Column(name="score1", type="integer", nullable=true)
     */
    private $score1;

    /**
     * @var integer
     *
     * @ORM\Column(name="score2", type="integer", nullable=true)
     */
    private $score2;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set startAt
     *
     * @param \DateTime $startAt
     *
     * @return Game
     */
    public function setStartAt($startAt)
    {
        $this->startAt = $startAt;

        return $this;
    }

    /**
     * Get startAt
     *
     * @return \DateTime
     */
    public function getStartAt()
    {
        return $this->startAt;
    }

    /**
     * Set place
     *
     * @param string $place
     *
     * @return Game
     */
    public function setPlace($place)
    {
        $this->place = $place;

        return $this;
    }

    /**
     * Get place
     *
     * @return string
     */
    public function getPlace()
    {
        return $this->place;
    }

    /**
     * Set score1
     *
     * @param integer $score1
     *
     * @return Game
     */
    public function setScore1($score1)
    {
        $this->score1 = $score1;

        return $this;
    }

    /**
     * Get score1
     *
     * @return integer
     */
    public function getScore1()
    {
        return $this->score1;
    }

    /**
     * Set score2
     *
     * @param integer $score2
     *
     * @return Game
     */
    public function setScore2($score2)
    {
        $this->score2 = $score2;

        return $this;
    }

    /**
     * Get score2
     *
     * @return integer
     */
    public function getScore2()
    {
        return $this->score2;
    }

    /**
     * Set team1
     *
     * @param \AppBundle\Entity\Team $team1
     *
     * @return Game
     */
    public function setTeam1(\AppBundle\Entity\Team $team1 = null)
    {
        $this->team1 = $team1;

        return $this;
    }

    /**
     * Get team1
     *
     * @return \AppBundle\Entity\Team
     */
    public function getTeam1()
    {
        return $this->team1;
    }

    /**
     * Set team2
     *
     * @param \AppBundle\Entity\Team $team2
     *
     * @return Game
     */
    public function setTeam2(\AppBundle\Entity\Team $team2 = null)
    {
        $this->team2 = $team2;

        return $this;
    }

    /**
     * Get team2
     *
     * @return \AppBundle\Entity\Team
     */
    public function getTeam2()
    {
        return $this->team2;
    }

    /**
     * Set prevGame1
     *
     * @param \AppBundle\Entity\Game $prevGame1
     *
     * @return Game
     */
    public function setPrevGame1(\AppBundle\Entity\Game $prevGame1 = null)
    {
        $this->prevGame1 = $prevGame1;

        return $this;
    }

    /**
     * Get prevGame1
     *
     * @return \AppBundle\Entity\Game
     */
    public function getPrevGame1()
    {
        return $this->prevGame1;
    }

    /**
     * Set prevGame2
     *
     * @param \AppBundle\Entity\Game $prevGame2
     *
     * @return Game
     */
    public function setPrevGame2(\AppBundle\Entity\Game $prevGame2 = null)
    {
        $this->prevGame2 = $prevGame2;

        return $this;
    }

    /**
     * Get prevGame2
     *
     * @return \AppBundle\Entity\Game
     */
    public function getPrevGame2()
    {
        return $this->prevGame2;
    }

    /**
     * Set tournament
     *
     * @param \AppBundle\Entity\Tournament $tournament
     *
     * @return Game
     */
    public function setTournament(\AppBundle\Entity\Tournament $tournament = null)
    {
        $this->tournament = $tournament;

        return $this;
    }

    /**
     * Get tournament
     *
     * @return \AppBundle\Entity\Tournament
     */
    public function getTournament()
    {
        return $this->tournament;
    }

    /**
     * Set level
     *
     * @param integer $level
     *
     * @return Game
     */
    public function setLevel($level)
    {
        $this->level = $level;

        return $this;
    }

    /**
     * Get level
     *
     * @return integer
     */
    public function getLevel()
    {
        return $this->level;
    }


}
