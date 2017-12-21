# Node Reference Block for Drupal 8 

GitHub: https://www.github.com/WondrousLLC/node_reference_block

## What Is This?

To use any node type to be referenced, displayed and used in block layout (```admin/structure/block```)
or in views header/footer, as well. Motivation: instead of creating custom blocks
use node content types to be placed anywhere on the page which makes content management and
content access easier.

Especially usefull in combination with [layout_plugin](https://www.drupal.org/project/layout_plugin) and [page_manager](https://www.drupal.org/project/page_manager).
There you can build a page and render view blocks together with Content Teaser and so on.

## How To Use with Block Layout

- Install the module
- e.g. under block layout select Node Reference
- Enter the Node you want to be rendered
- Select the view mode
- select the region where to place the block

## How To Use with Layout Plugin and Page Manager / Panels

- Install [layout_plugin](https://www.drupal.org/project/layout_plugin)
- Install [page_manager](https://www.drupal.org/project/page_manager)
- Install layout_plugin_examples for testing purposes
- Create a page using page_manager under structure/pages using block page with layout plugin integration
- Select a layout from the examples
- Place the Node Reference Block in the specified region
- Place as many blocks as you want.

## To Do

- write tests ( Manually tested using Beta 12 )

