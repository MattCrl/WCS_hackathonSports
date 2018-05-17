<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Tournament
 *
 * @ORM\Table(name="tournament")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TournamentRepository")
 */
class Tournament
{
    const GAME_LEVELS = [
        0 => 'Finale',
        1 => 'Demi-finales',
        2 => 'Quarts-de-finale',
        3 => 'Huitièmes-de-finale',
        4 => 'Seixièmes-de-finale'
    ];

    public function __toString()
    {
        return $this->getName();
    }

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var int
     *
     * @ORM\Column(name="nb_teams", type="integer")
     * @Assert\Choice(choices={"2", "4", "8", "16", "32"}, message="Choose a valid number.")
     */

    private $nbTeams;

    /**
     * @ORM\OneToMany(targetEntity="Game", mappedBy="tournament")
     * @ORM\OrderBy({"level":"DESC"})
     */
    private $games;

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
     * Set name
     *
     * @param string $name
     *
     * @return Tournament
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set nbTeams
     *
     * @param integer $nbTeams
     *
     * @return Tournament
     */
    public function setNbTeams($nbTeams)
    {
        $this->nbTeams = $nbTeams;

        return $this;
    }

    /**
     * Get nbTeams
     *
     * @return int
     */
    public function getNbTeams()
    {
        return $this->nbTeams;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->games = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add game
     *
     * @param \AppBundle\Entity\Game $game
     *
     * @return Tournament
     */
    public function addGame(\AppBundle\Entity\Game $game)
    {
        $this->games[] = $game;

        return $this;
    }

    /**
     * Remove game
     *
     * @param \AppBundle\Entity\Game $game
     */
    public function removeGame(\AppBundle\Entity\Game $game)
    {
        $this->games->removeElement($game);
    }

    /**
     * Get games
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGames()
    {
        return $this->games;
    }
}
