//
//  ViewController.m
//  DapiAssessment
//
//  Created by mina wefky on 17/02/2021.
//

#import "ViewController.h"
#import "SitesTableViewCell.h"

@interface ViewController ()

@end


//MARK:- URLs array
NSArray *urls;



@implementation ViewController

- (void)viewDidLoad {
    [super viewDidLoad];
    // URLs array initialization
    urls = [NSArray arrayWithObjects:
            @"apple.com",
            @"spacex.com",
            @"dapi.co",
            @"facebook.com",
            @"microsoft.com",
            @"amazon.com",
            @"boomsupersonic.com",
            @"twitter.com", nil];
    

}

//MARK:- Table View Data source

- (NSInteger)tableView:(UITableView *)tableView numberOfRowsInSection:(NSInteger)section{
    return [urls count];
}

- (UITableViewCell *)tableView:(UITableView *)tableView cellForRowAtIndexPath:(NSIndexPath *)indexPath{
    
    static NSString *cellId = @"SitesCell";
    
    SitesTableViewCell *cell = [tableView dequeueReusableCellWithIdentifier:cellId forIndexPath:indexPath];
    cell.siteName.text = urls[indexPath.row];
    return cell;
}

@end
