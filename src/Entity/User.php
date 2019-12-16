<?php
/**
 * @author bricelab <bricehessou@gmail.com>
 * @version 0.1
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Scheb\TwoFactorBundle\Model\Email\TwoFactorInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Security\Core\User\UserInterface;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ORM\Table(schema="common", name="app_user")
 * @ORM\HasLifecycleCallbacks()
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
 */
class User implements UserInterface, TwoFactorInterface, \Serializable
{
    use TimestampTrait;

    public const SEXE = [
        "MALE" => "MASCULIN",
        "FEMALE" => "FEMININ",
    ];

    /**
     * @var integer Identifier
     * 
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string Email adresse and username
     * 
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @var array Email adresse and username
     * 
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * 
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @var string The plaintext password
     */
    private $plainPassword;

    /**
     * @var string
     * 
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $firstname;

    /**
     * @var string
     * 
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $phonenumber;

    /**
     * @var string
     * 
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $address;

    /**
     * @var string
     * 
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $country;

    /**
     * @var string
     * 
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $city;

    /**
     * @var string
     * 
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $sexe;

    /**
     * @var \DateTime
     * 
     * @ORM\Column(type="date", nullable=true)
     */
    private $birthday;

    /**
     * @var File
     * 
     * @Vich\UploadableField(mapping="users_avatars", fileNameProperty="avatarName", size="avatarSize")
     */
    private $avatarFile;

    /**
     * @var string
     * 
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $avatarName;

    /**
     * @var integer
     * 
     * @ORM\Column(type="integer", nullable=true)
     */
    private $avatarSize;

    /**
     * @var string
     * 
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $token;

    /**
     * @ORM\Column(type="datetimetz", nullable=true)
     */
    private $passwordRequestedAt;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $authCode;

    /**
     * @ORM\Column(type="boolean", nullable=true, options={"default":false})
     */
    private $emailAuthEnabled;

    /**
     * @return integer|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string email
     * @return self
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @param array roles
     * @return self
     */
    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPlainPassword(): ?string
    {
        return (string) $this->plainPassword;
    }

    /**
     * @param string plainPassword
     * @return self
     */
    public function setPlainPassword(string $plainPassword): self
    {
        $this->plainPassword = $plainPassword;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    /**
     * @param string password
     * @return self
     */
    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        $this->plainPassword = null;
    }
    
    /**
     * getFirstname
     *
     * @return string
     */
    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    /**
     * setFirstname
     *
     * @param  string $firstname
     *
     * @return self
     */
    public function setFirstname(?string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * getLastname
     *
     * @return string
     */
    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    /**
     * setLastname
     *
     * @param  string $lastname
     *
     * @return self
     */
    public function setLastname(?string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * getPhonenumber
     *
     * @return string
     */
    public function getPhonenumber(): ?string
    {
        return $this->phonenumber;
    }

    /**
     * setPhonenumber
     *
     * @param  string $phonenumber
     *
     * @return self
     */
    public function setPhonenumber(?string $phonenumber): self
    {
        $this->phonenumber = $phonenumber;

        return $this;
    }

    /**
     * getAddress
     *
     * @return string
     */
    public function getAddress(): ?string
    {
        return $this->address;
    }

    /**
     * setAddress
     *
     * @param  string $address
     *
     * @return self
     */
    public function setAddress(?string $address): self
    {
        $this->address = $address;

        return $this;
    }

    /**
     * getCountry
     *
     * @return string
     */
    public function getCountry(): ?string
    {
        return $this->country;
    }

    /**
     * setCountry
     *
     * @param  string $country
     *
     * @return self
     */
    public function setCountry(?string $country): self
    {
        $this->country = $country;

        return $this;
    }

    /**
     * getCity
     *
     * @return string
     */
    public function getCity(): ?string
    {
        return $this->city;
    }

    /**
     * setCity
     *
     * @param  string $city
     *
     * @return self
     */
    public function setCity(?string $city): self
    {
        $this->city = $city;

        return $this;
    }

    /**
     * getSexe
     *
     * @return string
     */
    public function getSexe(): ?string
    {
        return $this->sexe;
    }

    /**
     * setSexe
     *
     * @param  string $sexe
     *
     * @return self
     */
    public function setSexe(?string $sexe): self
    {
        $this->sexe = $sexe;

        return $this;
    }

    /**
     * getBirthday
     *
     * @return \DateTimeInterface
     */
    public function getBirthday(): ?\DateTimeInterface
    {
        return $this->birthday;
    }

    /**
     * setBirthday
     *
     * @param  \DateTimeInterface $birthday
     *
     * @return self
     */
    public function setBirthday(?\DateTimeInterface $birthday): self
    {
        $this->birthday = $birthday;

        return $this;
    }  
    

    /**
     * Get the value of imageFile
     *
     * @return  File
     */ 
    public function getAvatarFile() : ?File
    {
        return $this->avatarFile;
    }

    /**
     * Set the value of imageFile
     *
     * @param  File  $imageFile
     *
     * @return  self
     */ 
    public function setAvatarFile(File $avatarFile) : self
    {
        $this->avatarFile = $avatarFile;

        return $this;
    }

    /**
     * Get the value of avatarName
     *
     * @return  string
     */ 
    public function getAvatarName() : ?string
    {
        return $this->avatarName;
    }

    /**
     * Set the value of avatarName
     *
     * @param  string  $avatarName
     *
     * @return  self
     */ 
    public function setAvatarName(string $avatarName) : self
    {
        $this->avatarName = $avatarName;

        return $this;
    }

    /**
     * Get the value of avatarSize
     *
     * @return  integer
     */ 
    public function getAvatarSize() : ?int
    {
        return $this->avatarSize;
    }

    /**
     * Set the value of avatarSize
     *
     * @param  integer  $avatarSize
     *
     * @return  self
     */ 
    public function setAvatarSize($avatarSize) : self
    {
        $this->avatarSize = $avatarSize;

        return $this;
    }

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function setToken(?string $token): self
    {
        $this->token = $token;

        return $this;
    }

    public function getPasswordRequestedAt(): ?\DateTimeInterface
    {
        return $this->passwordRequestedAt;
    }

    public function setPasswordRequestedAt(?\DateTimeInterface $passwordRequestedAt): self
    {
        $this->passwordRequestedAt = $passwordRequestedAt;

        return $this;
    }

    public function serialize()
    {
        return serialize([
                $this->id,
                $this->email,
                $this->password,
            ]
        );
    }

    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->email,
            $this->password
        ) = unserialize($serialized, ['allowed_classes' => false]);

    }

    public function isEmailAuthEnabled(): bool
    {
        return $this->emailAuthEnabled; // This can be a persisted field to switch email code authentication on/off
    }

    public function getEmailAuthRecipient(): string
    {
        return $this->email;
    }

    public function getEmailAuthCode(): string
    {
        return $this->authCode;
    }

    public function setEmailAuthCode(string $authCode): void
    {
        $this->authCode = $authCode;
    }

    /**
     * @return bool|null
     */
    public function hasEmailAuthEnabled(): ?bool
    {
        return $this->emailAuthEnabled;
    }

    /**
     * @param bool emailAuthEnabled
     * @return self
     */
    public function setEmailAuthEnabled(bool $emailAuthEnabled): self
    {
        $this->emailAuthEnabled = $emailAuthEnabled;

        return $this;
    }

    public function getAuthCode(): ?int
    {
        return $this->authCode;
    }

    public function setAuthCode(?int $authCode): self
    {
        $this->authCode = $authCode;

        return $this;
    }

    public function getEmailAuthEnabled(): ?bool
    {
        return $this->emailAuthEnabled;
    }
}
