//
//  SitesTableViewCell.h
//  DapiAssessment
//
//  Created by mina wefky on 17/02/2021.
//

#import <UIKit/UIKit.h>

NS_ASSUME_NONNULL_BEGIN

@interface SitesTableViewCell : UITableViewCell

@property (weak, nonatomic) IBOutlet UIImageView *siteUIIameg;
@property (weak, nonatomic) IBOutlet UILabel *siteName;
@property (weak, nonatomic) IBOutlet UILabel *siteResponse;
- (void)updateCell:(NSString*)totalBytes withImageName:(NSString*)image;
@end

NS_ASSUME_NONNULL_END
