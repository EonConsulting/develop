set list=app-store ck-editor-plugin-v2 file-manager Graphs ImgProcessor laravel-lti MindMap PHPSaasWrapper PHPStencil roles-permissions Storyline storyline-breadcrumbs storyline-core storyline-menu storyline-mindmap storyline-nav storyline-search storyline-table storyline-tagcloud

for %%a in (%list%) do (

   git subtree add --prefix=packages/%%a/ https://github.com/EonConsulting/%%a.git master
   
)
