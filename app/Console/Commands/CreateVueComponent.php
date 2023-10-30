<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CreateVueComponent extends Command
{
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'vue:create-component';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Create a Vue component on the specified path and with a predefined template';

  /**
   * Execute the console command.
   */
  public function handle()
  {
    $componentName = $this->ask('What is the name of the component?');
    $componentPath = $this->ask('What is the path of the component?');
    $isPageComponent = $this->confirm('Is this a page component?');

    $componentTemplate = <<<EOT
        <script setup lang="ts">
        </script>

        <template></template>

        <style scoped lang="scss">
        </style>
        EOT;

    $componentTemplate = str_replace('ComponentName', $componentName, $componentTemplate);
    $componentPath = str_replace('.', '/', $componentPath);

    if ($isPageComponent) {
      $componentPath = resource_path('js/Pages/' . $componentPath);
    } else {
      $componentPath = resource_path('js/Components/' . $componentPath);
    }

    if (!file_exists($componentPath)) {
      mkdir($componentPath, 0777, true);
    }

    file_put_contents($componentPath . '/' . $componentName . '.vue', $componentTemplate);

    $this->info('Component created successfully!');
  }
}
