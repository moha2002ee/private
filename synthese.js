var app = new Vue({
    el: "#app",
  
    data() {
      return {
        menuOpen: false,
        gsapMenuAnim: gsap.timeline({ paused: true }),
        menuList: [
          {
            title: "Section 1",
            items: [
              {
                text: "First item",
                url: "#"
              },
              {
                text: "Second item",
                url: "#"
              },
              {
                text: "Third item",
                url: "#"
              }
            ]
          },
          {
            title: "Section 2",
            items: [
              {
                text: "First item",
                url: "#"
              },
              {
                text: "Second item",
                url: "#"
              },
              {
                text: "Third item",
                url: "#"
              }
            ]
          },
          {
            title: "Section 3",
            items: [
              {
                text: "First item",
                url: "#"
              },
              {
                text: "Second item",
                url: "#"
              },
              {
                text: "Third item",
                url: "#"
              }
            ]
          },
          {
            title: "Section 4",
            items: [
              {
                text: "First item",
                url: "#"
              },
              {
                text: "Second item",
                url: "#"
              },
              {
                text: "Third item",
                url: "#"
              }
            ]
          },
          {
            title: "Section 5",
            items: [
              {
                text: "First item",
                url: "#"
              },
              {
                text: "Second item",
                url: "#"
              },
              {
                text: "Third item",
                url: "#"
              }
            ]
          },
          {
            title: "Section 6",
            items: [
              {
                text: "First item",
                url: "#"
              },
              {
                text: "Second item",
                url: "#"
              },
              {
                text: "Third item",
                url: "#"
              }
            ]
          },
          {
            title: "Section 7",
            items: [
              {
                text: "First item",
                url: "#"
              },
              {
                text: "Second item",
                url: "#"
              },
              {
                text: "Third item",
                url: "#"
              }
            ]
          },
          {
            title: "Section 8",
            items: [
              {
                text: "First item",
                url: "#"
              },
              {
                text: "Second item",
                url: "#"
              },
              {
                text: "Third item",
                url: "#"
              }
            ]
          }
        ]
      };
    },
  
    computed: {
      isMobile() {
        let mediaQueryList = window.matchMedia("(min-width: 1024px)");
        console.log("mediaquerylist", mediaQueryList.matches);
        return !mediaQueryList.matches;
      },
  
      // Groups menuItems in groups of 2
      blocksPerWidth() {
        if (!this.isMobile) {
          const grouppedArray = _.chunk(this.menuList, 2);
          // console.log(grouppedArray)
          return grouppedArray;
        }
      }
    },
  
    methods: {
      
      closeMenu() {
        this.menuOpen = false
      },
      
      toggleMenu: function() {
        if (!this.menuOpen) {
          this.menuOpen = true;
          this.gsapMenuAnim.play();        
        } else {
          this.gsapMenuAnim.eventCallback('onReverseComplete', this.closeMenu);
          this.gsapMenuAnim.reverse();
        }
      }
    },
  
    mounted: function () {
      
      // console.log('gsapMenuAnim: ', this.gsapMenuAnim);
      
      // if (!this.isMobile) {
        // var tl = this.gsapMenuAnim;
      
       this.gsapMenuAnim.set(".foldable", {
          perspective: 3000
        });
  
        this.gsapMenuAnim.set(".fold", {
          transformOrigin: "0% 50% 0",
          rotationY: 90,
          backgroundColor: "#32BED7",
          opacity: 0
        });
  
        this.gsapMenuAnim.to(".fold", {
          rotationY: 0,
          // ease: "power2.out",
          stagger: 0.14,
          backgroundColor: "#e9f9fc",
          opacity: 1,
          duration: 0.25
        });
  
        this.gsapMenuAnim.to(".white", {
          backgroundColor: "#ffffff"
        });
      
        
          
        
        
        
      }
    // }
  });
  