<?php

namespace Kullenen\Co2\Doctrine\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Co2mon
 *
 * @ORM\Table(name="co2mon", uniqueConstraints={@ORM\UniqueConstraint(name="time", columns={"time", "locationId"})}, indexes={@ORM\Index(name="locationId", columns={"locationId"})})
 * @ORM\Entity(repositoryClass="Kullenen\Co2\Doctrine\Repositories\Co2monRepository")
 */
class Co2mon
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", precision=0, scale=0, nullable=false, unique=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="time", type="datetime", precision=0, scale=0, nullable=false, unique=false)
     */
    private $time;

    /**
     * @var int|null
     *
     * @ORM\Column(name="ppm", type="integer", precision=0, scale=0, nullable=true, unique=false)
     */
    private $ppm;

    /**
     * @var float|null
     *
     * @ORM\Column(name="temp", type="float", precision=10, scale=0, nullable=true, unique=false)
     */
    private $temp;

    /**
     * @var int
     *
     * @ORM\Column(name="locationId", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $locationid;


    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set time.
     *
     * @param \DateTime $time
     *
     * @return Co2mon
     */
    public function setTime($time)
    {
        $this->time = $time;

        return $this;
    }

    /**
     * Get time.
     *
     * @return \DateTime
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * Set ppm.
     *
     * @param int|null $ppm
     *
     * @return Co2mon
     */
    public function setPpm($ppm = null)
    {
        $this->ppm = $ppm;

        return $this;
    }

    /**
     * Get ppm.
     *
     * @return int|null
     */
    public function getPpm()
    {
        return $this->ppm;
    }

    /**
     * Set temp.
     *
     * @param float|null $temp
     *
     * @return Co2mon
     */
    public function setTemp($temp = null)
    {
        $this->temp = $temp;

        return $this;
    }

    /**
     * Get temp.
     *
     * @return float|null
     */
    public function getTemp()
    {
        return $this->temp;
    }

    /**
     * Set locationid.
     *
     * @param int $locationid
     *
     * @return Co2mon
     */
    public function setLocationid($locationid)
    {
        $this->locationid = $locationid;

        return $this;
    }

    /**
     * Get locationid.
     *
     * @return int
     */
    public function getLocationid()
    {
        return $this->locationid;
    }
}
