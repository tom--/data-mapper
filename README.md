Data mapping in Yii 2
=====================

The "master" branch contains the [Yii 2 Basic Project Template](https://github.com/yiisoft/yii2-app-basic).

The "rating" branch has a trivial database-wrapper application for user to rate movies implemented
using one conception of the data mapper concept using Yii 2.

### The general idea

I like to imagine the architecture as having three layers:

```
     Business   |  Domain   |    Database
       logic    |  objects  |    models
```

- **Business logic** layer typically uses models (such as `yii\base\Model`) that encapsulate, for each 
    client interaction:
    - the representation of the i/o data fields (e.g. form fields) and their labels and hints
    - provides input validation and error messages
    - implements the business logic of the client interaction
    - maps between its own model and the internal data objects
- **Database models** are, in our context, Yii Active Record models that
    - provide an API to the persistent storage, e.g. SQL or NoSQL DB
    - represent and have the structure of the database schema
    - change when we migrate the schema
    - do not understand how they map to internal data objects or business logic models
- **Domain objects** are instances of internal data model classes that
    - mostly just provide public properties representing application data
    - function as the interface separating biz-logic from database
    - are the *canonical form* for representation of app-internal data 
    that all business logic developers have to respect and honor
    - provide the layer of indirection that isolates (de-couples) biz-logic 
    from database, including database structures, tables, fields, technologies

The alert reader will have noticed that nothing in the above ontology knows the mapping
between database models and domain objects. There is indeed another category of
classes that I call "store classes". They probably live in the data objects layer, if
anywhere.

- **Store classes** contain mostly methods that
    - understand the mapping between between database models and domain objects
    - provide the internal API that biz-logic uses to CRUD the internal data objects
    
    This API the mappings  are *ad hoc* and can easily be changed to accommodate whatever 
    the biz-logic needs.
    
### Compared to the Gii AR/Form models
    
The architecture described above is rather more elaborate than the kind of models 
that Gii generates. Its models collapse the business logic's form model and database 
AR models into one. This works when the
form corresponds tightly with the AR model, e.g. if the form has a simple subset of
the table's fields, and when only one form works with that table.

When you need a form with fields substantially different from any one database table,
you might use a form model separate from the AR model. Given that there might eventually
a lot of forms using fewer tables, it makes sense to put the mapping between form and AR 
models in the form models.

Now imagine that you've implemented the database and lots of forms and biz-logic when
you realize that the database schema needs to change. Perhaps you discover that need to 
normalize or de-normalize a table. If you are unlucky, you might need to change lots of
form models because you have to fix the mapping between those form models and the 
revised schema and AR models. This kind of scenario is not uncommon in larger systems. The 
refactor can be so nasty that it dooms a project.


### The hard part

So you can see how separating

- Form models with biz-logic
- Domain models
- AR models
- Domain model storage classes

decouples things that really don't want to be coupled at all if you can avoid it.

The extra burden adopting the data mapping approach and writing all these classes is not 
very much. In larger systems its insignificant. This isn't the hard part.

What's hard is designing the domain objects. They are your internal standards, the spec that
everyone else has to conform to. But at the start of a project it can be hard to know what
the domain objects should be or their details.


### The example app: users rating movies

In our example app there are:

- users, who log in to use the app
- movies listed in the database
- the user can add or revise her ratings of each movie
- the app displays the summary of all movie ratings

The ontology of models divided into the layers described above are

```
     Business   |  Domain   |    Database
       logic    |  objects  |    models
    ------------------------------------------
                |   User    |   UserRecord
    LoginForm   |           |
                |   Rating  |   RatingRecord
    RateForm    |           |
                |   Movie   |   MovieRecord
```

There's a store class for each type of domain object. Note: each also has a NotFound exception 
because we don't return `null` to indicate not-found from the store class APIs to their 
biz-logic clients.


