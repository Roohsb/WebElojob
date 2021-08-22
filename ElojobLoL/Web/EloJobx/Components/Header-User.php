<?php 

echo '<div id="sidebar">
                  <div id="sidebar-scroll">
                     <div class="sidebar-content">
                        <a href="#" class="sidebar-brand">
                        <img src="http://localhost:81/Template/imagens/logo_w.png" style="max-height: 90px;" />
                        </a>
                        <div class="sidebar-section sidebar-user clearfix sidebar-nav-mini-hide">
                           <div class="sidebar-user-avatar">
                              <a href="/user/perfil">
                              <img src="/Template/imagens/profiles/avatar/'.ImagesUser(1,GetDateUser($Server)[1]["avatar"],$Server)["img"].'" alt="Lucifer">
                              </a>
                           </div>
                           <div class="sidebar-user-name">'.GetDateUser($Server)[0]["nome"].'</div>
                           <div class="sidebar-user-links">
                              <a href="/user/perfil" data-toggle="tooltip" data-placement="bottom" title="Perfil"><i class="gi gi-user"></i></a>
                              <a href="javascript:void(0)" class="enable-tooltip" data-placement="bottom" title="Definições" onclick="if (!window.__cfRLUnblockHandlers) return false; $(\'#modal-user-settings\').modal(\'show\');" data-cf-modified-86d7530037d1dd452fe77e2e-=""><i class="gi gi-cogwheel"></i></a>
                              <a href="http://localhost:81/api/autenticacao/sair" data-toggle="tooltip" data-placement="bottom" title="Sair"><i class="gi gi-exit"></i></a>
                           </div>
                        </div>
                        <ul class="sidebar-section sidebar-themes clearfix sidebar-nav-mini-hide">';
                        ThemesEloList($Server, 0, null);
                        echo '</ul>
                        <ul class="sidebar-nav">
                           <li>
                              <a href="/user/centro" data-active="centro"><i class="gi gi-stopwatch sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Dashboard</span></a>
                           </li>
                          

                           <li>
                              <a href="http://localhost:81" data-active="centro"><i class="gi gi-refresh"></i><span class="sidebar-nav-mini-hide">WebSite</span></a>
                           </li>
                           <li class="sidebar-header">
                              <span class="sidebar-header-title">Cliente</span>
                           </li>
                           <li>
                              <a href="/user/atualizacoes" data-active="atualizacoes"><i class="gi gi-warning_sign sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Avisos</span></a>
                           </li>
                           <li>
                              <a href="#" class="sidebar-nav-menu"><i class="fa fa-angle-left sidebar-nav-indicator sidebar-nav-mini-hide"></i><i class="gi gi-list sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Compras</span></a>
                              <ul>
                                 <li>
                                    <a href="/user/compras">Serviços</a>
                                 </li>
                              </ul>
                           </li>
                          
                           <li>
                              <a href="#" class="sidebar-nav-menu" data-active="cadastrar-lol">
                              <i class="fa fa-angle-left sidebar-nav-indicator sidebar-nav-mini-hide"></i>
                              <i class="gi gi-gamepad sidebar-nav-icon"></i>
                              <span class="sidebar-nav-mini-hide">Contas LOL</span></a>
                              <ul>
                                 <li>
                                    <a href="/user/cadastrar-lol">Cadastrar</a>
                                 </li>
                                 <li>
                                    <a href="/user/gerenciar-lol" data>Gerenciar</a>
                                 </li>
                              </ul>
                           </li>
                           
                          
                           <li class="sidebar-header">
                              <span class="sidebar-header-title">Suporte</span>
                           </li>
                           <li>
                              <a href="#" class="sidebar-nav-menu" data-active="tickets"><i class="fa fa-angle-left sidebar-nav-indicator sidebar-nav-mini-hide"></i><i class="fa fa-ticket sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Tickets</span></a>
                              <ul>
                                 <li>
                                    <a href="http://localhost:81/api/ticket/novo">Novo</a>
                                 </li>
                                 <li>
                                    <a href="http://localhost:81/api/ticket/gerenciar">Gerenciar</a>
                                 </li>
                              </ul>
                           </li>
                        </ul>
                     </div>
                  </div>
               </div>
               <div id="main-container">
                  <header class="navbar navbar-inverse">
                     <ul class="nav navbar-nav-custom">
                        <li>
                           <a href="javascript:void(0)" onclick="if (!window.__cfRLUnblockHandlers) return false; App.sidebar(\'toggle-sidebar\');this.blur();" data-cf-modified-86d7530037d1dd452fe77e2e-="">
                           <i class="fa fa-bars fa-fw"></i>
                           </a>
                        </li>
                     </ul>
                     <ul class="nav navbar-nav-custom pull-right">
                        <li class="dropdown">
                           <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
                           <img src="/Template/imagens/profiles/avatar/'.ImagesUser(1,GetDateUser($Server)[1]["avatar"],$Server)["img"].'" alt="Lucifer"> <i class="fa fa-angle-down"></i>
                           </a>
                           <ul class="dropdown-menu dropdown-custom dropdown-menu-right">
                              <li>
                                 <a href="/user/perfil">
                                 <i class="fa fa-user fa-fw pull-right"></i>
                                 Perfil
                                 </a>
                                 <a href="#modal-user-settings" data-toggle="modal">
                                 <i class="fa fa-cog fa-fw pull-right"></i>
                                 Definições
                                 </a>
                              </li>
                              <li class="divider"></li>
                              <li>
                                 <a href="/api/logout"><i class="fa fa-close fa-fw pull-right"></i> Sair</a>
                              </li>
                           </ul>
                        </li>
                     </ul>
                  </header>';