#AppVerk  SectionBundle
	
1. Update composer.json file: 
```json
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/AppVerk/Components"
        },
        {
            "type": "vcs",
            "url": "https://github.com/AppVerk/sectionBundle"
        }
    ]
```
2. Add to Your composer.json file:
```json
        "app-verk/section-bundle": "dev-master",
        "app-verk/components": "dev-master",
```
3. Run ```composer install```
4. Run ```bin/console doctrine:schema:update --force```
5. Enable bundle in Your AppKernel.php file:
```php
    new AppVerk\SectionBundle\SectionBundle(),
```
6. add section.yml file in Your config directory
7. import section.yml in Your config file:
``` yaml
    - { resource: section.yml }
```
8. Add section bundle to Your routing:
``` yaml
    section:
        resource: '@SectionBundle/Controller/'
        type: annotation
```

9. section.yml file configuration options:
```yaml
section:
    options:
        translatable: true
        languages:
            - { code: 'pl', name: 'Polish', default: true }
            - { code: 'en', name: 'English', default: false }

    sections:
        simple:
            name: 'simple'
            model: AppVerk\SectionBundle\Entity\SectionDefault
            fields:
                - { type: input, text: 'simple', title: 'simple', name: 'simple' }
                - { type: html, title: 'html simple', name: 'html_simple' }
                - { type: txt, title: 'simple description', name: 'simple_description' }
                - { type: choice, control: 'radio', label: 'simple position', name: 'simple_position', settings: true, options: [ { label: 'left', name: 'simple_position', value: 'simple_picture_left' }, {label: 'right', name: 'simple_position', value: 'simple_picture_right'} ] }
            views:
                create: '@Section/sections/create.html.twig'
                edit: '@Section/sections/edit.html.twig'
                remove: '@Section/sections/remove.html.twig'
                front: '@Section/sections/show.html.twig'

    fields:
        html:
            factory: AppVerk\SectionBundle\Factory\FieldHTMLFactory
            views:
                edit: '@Section/fields/edit.html.twig'
                remove:
        txt:
            factory: AppVerk\SectionBundle\Factory\FieldTXTFactory
            views:
                edit: '@Section/fields/edit.html.twig'
                remove:
        input:
            factory: AppVerk\SectionBundle\Factory\FieldInputFactory
            views:
                edit: '@Section/fields/edit.html.twig'
                remove: '@Section/fields/remove.html.twig'

```

