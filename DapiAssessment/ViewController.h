//
//  ViewController.h
//  DapiAssessment
//
//  Created by mina wefky on 17/02/2021.
//

#import <UIKit/UIKit.h>

@interface ViewController : UIViewController<UITableViewDataSource,
UITableViewDelegate>

@property (weak, nonatomic) IBOutlet UITableView *tableView;
@end

