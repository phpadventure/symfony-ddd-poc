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

# Current milestones
- check requests on /bmw, /bmw-list, /test, /time, /items. This will test functionality for collection and work or db repositories and rest mappers.

# Contexts
For bounded contexts use isolated containers. They are located in Contexts/{name}/Configs folder.
Each module also contain its container. Location : Contexts/{name}/Modules/{name}/Configs folder.
To improve perfomance all service contexts are registered in app container provided by symfony and be used in app/presentation layer with full powerfull functionality of symfony DI.
To give access to all infrastructure service, infrusture services are mereged into app containe as a configuration file.
App container used as mediator pattern and passed back into service context to get access to other context services and infrustructure services.
  
 Containers is main place of interacting isolated domain from vendor with app/infrustructure based on IoC and abstractions.
  
# Rest mapper
Used guzzle as http client, and created based http mapper which cover requests.

# DB repository
Used doctrine ORM. Based on IoC injected all repositiories in services.
  
  
