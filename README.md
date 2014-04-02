SupportBundle
=============

Support ticket bundle for Symfony2 applications

###Configuration

Main configuration:

```yml
# app/config/config.yml

bez_support:
    
    # Substitute with your own entity class implementing TicketInterface, 
    # preferably extending Bez\SupportBundle\Entity\Ticket to inherit pre-configured mapping.
    ticket_class: Acme\FooBundle\Entity\Ticket
    
    # Substitute with your own entity class implementing CommentInterface,
    # preferably extending Bez\SupportBundle\Entity\Comment to inherit pre-configured mapping.
    comment_class: Acme\FooBundle\Entity\Comment

    # Substitute with your main user class (from FOSUserBundle, etc.)
    # Must implement Bez\SupportBundle\Entity\AuthorInterface
    # This bundle does not really handle persistence of these objects, 
    # but needs this config value for associations.
    author_class: Acme\FooBundle\Entity\User

    # The entity manager to use for this bundle. [Doctrine#getManager call]
    object_manager_name: null

```

__Important Doctrine configuration__:

```yml
# app/config/config.yml

doctrine:
    orm:
        resolve_target_entities:
            
            #Use same values set for "ticket_class" and "author_class" in "bez_support" config block.
            Bez\SupportBundle\Entity\AuthorInterface: Acme\FooBundle\Entity\User
            Bez\SupportBundle\Entity\TicketInterface: Acme\FooBundle\Entity\Ticket
