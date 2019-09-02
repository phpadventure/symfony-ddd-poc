# symfony-ddd-poc
Symfony based implementation for ddd, using clean architecture and mapper/repositories approach.
This direct implementaion as example which can be copied and reused.
Use symfony as primary vendor for app development because of wide usage and powerfull comunity, features developed for it.

# Conceptual idea:
- used commonly used symfony framework for enterprise app as main Infrastructure vendor
- prepare code structure for DDD
- based on clean architecture separate domain from framework code.
- use mappers/repository for data handling, and make them configurable and reusable
- make isolated contexts through separate DI
- used mediator pattern for containers to communicate between contexts. Mediator is app container

# TODO list
- cover code with test and remove dummy controllers
- split project into separate repos and make it fully reusable

