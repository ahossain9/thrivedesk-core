"use strict";
window.Thrivedesk = window.Thrivedesk || {};

(function ($, Thrivedesk, w) {
	var $window = $(w);

    var TabHandlerBase = elementorModules.frontend.handlers.Base.extend({
			$activeContent: null,

			getDefaultSettings: function () {
				return {
					selectors: {
						tabTitle: ".td-tab__title",
						tabContent: ".td-tab__content",
					},
					classes: {
						active: "td-tab--active",
					},
					showTabFn: "show",
					hideTabFn: "hide",
					toggleSelf: false,
					hidePrevious: true,
					autoExpand: true,
				};
			},

			getDefaultElements: function () {
				var selectors = this.getSettings("selectors");

				return {
					$tabTitles: this.findElement(selectors.tabTitle),
					$tabContents: this.findElement(selectors.tabContent),
				};
			},

			activateDefaultTab: function () {
				var settings = this.getSettings();

				if (
					!settings.autoExpand ||
					("editor" === settings.autoExpand && !this.isEdit)
				) {
					return;
				}

				var defaultActiveTab =
						this.getEditSettings("activeItemIndex") || 1,
					originalToggleMethods = {
						showTabFn: settings.showTabFn,
						hideTabFn: settings.hideTabFn,
					};

				// Toggle tabs without animation to avoid jumping
				this.setSettings({
					showTabFn: "show",
					hideTabFn: "hide",
				});

				this.changeActiveTab(defaultActiveTab);

				// Return back original toggle effects
				this.setSettings(originalToggleMethods);
			},

			deactivateActiveTab: function (tabIndex) {
				var settings = this.getSettings(),
					activeClass = settings.classes.active,
					activeFilter = tabIndex
						? '[data-tab="' + tabIndex + '"]'
						: "." + activeClass,
					$activeTitle =
						this.elements.$tabTitles.filter(activeFilter),
					$activeContent =
						this.elements.$tabContents.filter(activeFilter);

				$activeTitle.add($activeContent).removeClass(activeClass);

				$activeContent[settings.hideTabFn]();
			},

			activateTab: function (tabIndex) {
				var settings = this.getSettings(),
					activeClass = settings.classes.active,
					$requestedTitle = this.elements.$tabTitles.filter(
						'[data-tab="' + tabIndex + '"]'
					),
					$requestedContent = this.elements.$tabContents.filter(
						'[data-tab="' + tabIndex + '"]'
					);

				$requestedTitle.add($requestedContent).addClass(activeClass);

				$requestedContent[settings.showTabFn]();
			},

			isActiveTab: function (tabIndex) {
				return this.elements.$tabTitles
					.filter('[data-tab="' + tabIndex + '"]')
					.hasClass(this.getSettings("classes.active"));
			},

			bindEvents: function () {
				var _this = this;

				this.elements.$tabTitles.on({
					keydown: function keydown(event) {
						if ("Enter" === event.key) {
							event.preventDefault();

							_this.changeActiveTab(
								event.currentTarget.getAttribute("data-tab")
							);
						}
					},
					click: function click(event) {
						event.preventDefault();

						_this.changeActiveTab(
							event.currentTarget.getAttribute("data-tab")
						);
					},
				});
			},

			onInit: function () {
				elementorModules.frontend.handlers.Base.prototype.onInit.apply(
					this,
					arguments
				);
				this.activateDefaultTab();
			},

			onEditSettingsChange: function (propertyName) {
				if ("activeItemIndex" === propertyName) {
					this.activateDefaultTab();
				}
			},

			changeActiveTab: function (tabIndex) {
				var isActiveTab = this.isActiveTab(tabIndex),
					settings = this.getSettings();

				if (
					(settings.toggleSelf || !isActiveTab) &&
					settings.hidePrevious
				) {
					this.deactivateActiveTab();
				}

				if (!settings.hidePrevious && isActiveTab) {
					this.deactivateActiveTab(tabIndex);
				}

				if (!isActiveTab) {
					this.activateTab(tabIndex);
				}
			},
		});


	$window.on("elementor/frontend/init", function () {
        elementorFrontend.hooks.addAction(
            "frontend/element_ready/td-advanced-tabs.default",
            function ($scope) {
                elementorFrontend.elementsHandler.addHandler(TabHandlerBase, {
                    $element: $scope,
                });
            }
        );
		
	});

    
})(jQuery, Thrivedesk, window);
